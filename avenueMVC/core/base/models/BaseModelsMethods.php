<?php

namespace core\base\models;

abstract class BaseModelsMethods{

    protected $sqlFunc = ['NOW()'];

    protected function createFields($set, $table = false){

        $set['fields'] =  (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : ['*']; // если есть то он и будет если нет то выбрать все

        $table = ($table && !$set['no_concat']) ? $table . '.' : ''; // если есть то он и будет c точкой в конце если нет то пустая строка

        $fields = '';

        foreach ($set['fields'] as $field){
            $fields .= $table . $field . ','; // получится к примеру name.id
        }

        return $fields;
    }

    protected function createOrder($set, $table = false){

        $table = ($table && !$set['no_concat']) ? $table . '.' : ''; // если есть то он и будет c точкой в конце если нет то пустая строка

        $order_by = '';

        if(is_array($set['order']) && !empty($set['order'])){

            $set['order_direction'] =  (is_array($set['order_direction']) && !empty($set['order_direction']))
                ? $set['order_direction'] : ['ASC']; // если есть то он и будет если нет то вібрать все

            $order_by = 'ORDER BY ';

            $direct_count = 0;

            foreach ($set['order'] as $order){
                if ($set['order_direction'][$direct_count]){ //если подобная ячейка существует

                    $order_direction = strtoupper($set['order_direction'][$direct_count]);
                    $direct_count++;

                }else{

                    $order_direction = strtoupper($set['order_direction'][$direct_count - 1]);

                }

                if(is_int($order)) $order_by .= $order . ' ' . $order_direction . ',';
                else $order_by .= $table . $order . ' ' . $order_direction . ',';
            }

            $order_by = rtrim($order_by, ',');

        }

        return $order_by;

    }

    protected function createWhere($set, $table = false, $instruction = 'WHERE'){

        $table = ($table && !$set['no_concat']) ? $table . '.' : ''; // если есть то он и будет c точкой в конце если нет то пустая строка

        $where = '';

        if(is_string($set['where'])){
            return $instruction . ' ' . trim($set['where']);
		}

        if (is_array($set['where']) && !empty($set['where'])) { // пришел ли массив и не пуст ли он

            $set['operand'] = (is_array($set['operand']) && !empty($set['operand'])) ? $set['operand'] : ['='];
            $set['condition'] = (is_array($set['condition']) && !empty($set['condition'])) ? $set['condition'] : ['AND'];

            $where = $instruction;

            $o_count = 0;
            $c_count = 0;

            foreach ($set['where'] as $key => $item) {

                $where .= ' ';

                if ($set['operand'][$o_count]) {
                    $operand = $set['operand'][$o_count];
                    $o_count++;
                } else {
                    $operand = $set['operand'][$o_count - 1];
                }

                if ($set['condition'][$c_count]) {
                    $condition = $set['condition'][$c_count];
                    $c_count++;
                } else {
                    $condition = $set['condition'][$c_count - 1];

                }

                if ($operand === 'IN' || $operand === 'NOT IN') {

                    if (is_string($item) && strpos($item, 'SELECT') === 0){ //если в массиве масив
                        $in_str = $item;
                    } else {
                        if (is_array($item)) $temp_item = $item; // не пришел ли масив 
                        else $temp_item = explode(',', $item); // разбиваем масив через запятую

                        $in_str = '';

                        foreach ($temp_item as $v) {
                            $in_str .= "'" . addslashes(trim($v)) . "',";
                        }
                    }

                    $where .= $table . $key . ' ' .$operand . ' (' . trim($in_str, ',') . ') ' . $condition; //названиие таблици, где, IN (SELECT)


                } elseif (strpos($operand, 'LIKE') !== false) { // если строка LIKE есть

                    $like_template = explode('%', $operand); // если % будет перед то первій елемент масива пустота

                    foreach ($like_template as $lt_key => $lt) {
                        if (!$lt) { // если первый елемент пришол пустой , то есть перед LIKE стоит знак %
                            if (!$lt_key) { //если ничего не пришло
                                $item = '%' . $item;
                            } else {
                                $item .= '%';
                            }
                        }
                    }

                    $where .= $table . $key . ' LIKE ' . "'" . addslashes($item) . "' $condition";

                } else {

                    if (strpos($item, 'SELECT') === 0) { //если на первой позиции
                        $where .= $table . $key . $operand . '(' . $item . ") $condition";
                    } else {
                        $where .= $table . $key . $operand . "'" . addslashes($item) . "' $condition";
                    }
                }
            }

            $where = substr($where, 0, strrpos($where, $condition));

        }

        return $where;

    }

    protected function createJoin($set, $table, $new_where = false){

        $fields = '';
        $join = '';
        $where = '';
        $tables = '';

        if($set['join']){ // если есть join запрос

            $join_table = $table; // имя таблици

            foreach($set['join'] as $key => $item){
                if(is_int($key)){// если это числовой масив
                    if(!$item['table']) continue; // если названия таблици нет, продолжим
                    else $key = $item['table']; // запишем таблицу
                }

                if($join) $join .= ' '; // если есть JOIN запрос то контакетируем

                if($item['on']){ // если есть

                    $join_fields = [];

                    switch (2){

                        case count($item['on']['fields']): // считаем елементы масива, если их два
                            $join_fields = $item['on']['fields'];
                            break;

                        case count($item['on']):
                            $join_fields = $item['on'];
                            break;

                        default:
                            continue 2;
                            break;

                    }

                    if(!$item['type']) $join .= 'LEFT JOIN '; // если нет типа то по умолчанию
                    else $join .= trim(strtoupper($item['type'])). ' JOIN '; // если есть то в верхний регист и конкатенируем

                    $join .= $key . ' ON ';

                    if($item['on']['table']) $join .= $item['on']['table']; //если таблица существует то должны пристыковать таблица
                    else $join .= $join_table; // предыдущая таблица

                    $join .= '.' . $join_fields[0] . '=' . $key . '.' . $join_fields[1]; //

                    $join_table = $key;
                    $tables .= ', ' . trim($join_table);

                    if($new_where){

                        if($item['where']){ // если будет какое то условие
                            $new_where = false;
                        }

                        $group_condition = 'WHERE';

                    }else{
                        $group_condition = $item['group_condition'] ? strtoupper($item['group_condition']) : 'AND';
                    }

                    $fields .= $this->createFields($item, $key);
                    $where .= $this->createWhere($item, $key, $group_condition);

                }
            }
        }

        return compact('fields', 'join', 'where' , 'tables');

    }

    protected function createInsert($fields, $files, $except){

        $insert_arr = []; // массив в котором хранится строка названия поля и значение єтого поля 'name' => 'Natasha'

        $insert_arr['fields'] = '(';

        $array_type = array_keys($fields)[0]; // какой тип числовой (многомерный массив) или строка (асоциативный)

        if(is_int($array_type)){ // если это число (многомерный массив)

            $check_fields = false; // Флаг
            $count_fields = 0; // Подсчет количества полей в первом масиве

            foreach($fields as $i => $item){

                $insert_arr['values'] .= '('; // на каждой литерации открываем скобку

                if(!$count_fields) $count_fields = count($fields[$i]); //если еще не посчитаны количство елементов в первом елементе многомерного массива,
                //то добавляем число количества елементов в первом елементе многомерного массива
                $j = 0;

                foreach($item as $row => $value){

                    if($except && in_array($row , $except)) continue; //если в массиве есть исключение и в нем есть поле которое надо исключить то просто продолжим

                    if(!$check_fields) $insert_arr['fields'] .= $row . ','; // если есть поля, добаляем в стору название полей через запятую (Natasha,

                    if(in_array($value, $this->sqlFunc)){ // если в массиве есть msql функция NOW
                        $insert_arr['values'] .= $value . ','; // то в строку добавляе функию и ставим запятую (NOW(),
                    }elseif($value == 'NULL' || $value === NULL){ // если значение пусто или NULL
                        $insert_arr['values'] .= "NULL" . ','; // то в строку добавил просто NULL и запятую, (NULL,
                    }else{
                        $insert_arr['values'] .= "'" . addslashes($value) . "',"; // в противном случае записываем поля в ковычках через запятую ('Natasha','1.png',
                    }

                    $j++; // увеличиваем счетчик

                    if($j === $count_fields) break; //если счетчик равен количеству елементов в поле каждого масива
                }

                if($j < $count_fields){ // если во втором масиве больше полей чем в первом
                    for(; $j < $count_fields; $j++){
                        $insert_arr['values'] .= "NULL" . ','; // записываем записіваем пустую строку и запятую ('Natasha','1.png', ,
                    }
                }

                $insert_arr['values'] = rtrim($insert_arr['values'], ',') . '),'; // обрезаем запятую

                if(!$check_fields) $check_fields = true; // поля не будут заполняться
            }

        }else{

            $insert_arr['values'] = '(';

            if($fields){

                foreach($fields as $row => $value){

                    if($except && in_array($row , $except)) continue; //если в массиве есть исключение и в нем есть поле которое надо исключить то просто продолжим

                    $insert_arr['fields'] .= $row . ',';

                    if(in_array($value, $this->sqlFunc)){ // если в массиве есть msql функция NOW
                        $insert_arr['values'] .= $value . ','; // то в строку добавляе функию и ставим запятую (NOW(),
                    }elseif($value == 'NULL' || $value === NULL){ // если значение пусто или NULL
                        $insert_arr['values'] .= "NULL" . ','; // то в строку добавил просто NULL и запятую, (NULL,
                    }else{
                        $insert_arr['values'] .= "'" . addslashes($value) . "',"; // в противном случае записываем поля в ковычках через запятую ('Natasha','1.png',
                    }
                }
            }

            if($files){

                foreach ($files as $row => $file){

                    $insert_arr['fields'] .= $row . ',';

                    if(is_array($file)) $insert_arr['values'] .= "'" . addslashes(json_encode($file)) . "',";  //если это массив, то добавляем в строку переобразовыны в json строку названия файлов
                    else $insert_arr['values'] .= "'" . addslashes($file) . "',"; // если не масив то записываем просто в строку
                }

            }

            $insert_arr['values'] = rtrim($insert_arr['values'], ',') . ')'; //обрезаем запятую и убираем скобку

        }

        $insert_arr['fields'] = rtrim($insert_arr['fields'], ',') . ')'; //обрезаем запятую и закріваем скобку в полях
        $insert_arr['values'] = rtrim($insert_arr['values'], ','); //обрезаем запятую

        return $insert_arr;
    }

    protected function createUpdate($fields, $files, $except){

        $update = '';

        if($fields){
            foreach($fields as $row => $value) {

                if ($except && in_array($row, $except)) continue;

                $update .= $row . '=';

                if (in_array($value, $this->sqlFunc)) {
                    $update .= $value . ',';
                }elseif ($value === NULL){
                    $update .= "NULL" . ',';
                }else{
                    $update .= "'" . addslashes($value) . "',";
                }

            }
        }

        if($files){

            foreach($files as $row => $file){

                $update .= $row . '=';

                if(is_array($file)) $update .= "'" . addslashes(json_encode($file)) . "',";
                else $update .= "'" . addslashes($file) . "',";
            }
        }

        return rtrim($update, ',');

    }

}



?>