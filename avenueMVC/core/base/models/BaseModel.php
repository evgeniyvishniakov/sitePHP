<?php

namespace core\base\models;

use core\base\controllers\Singleton;
use core\base\exceptions\DbException;


class BaseModel{
	
	use Singleton; // подключаем синглтон
	
	protected $db;
	
	private function __construct(){
		
		$this->db = @new \mysqli(HOST, USER, PASS, DB_NAME); // подключение к базе данных
		
		if($this->db->connect_error){ // если в подключении что либо есть
			throw new DbException('Ошибка подключения к базе данных:' . $this->db->connect_errno . ' ' .  $this->db->connect_error); // записываем сообщение об ошибке
		}
		
		$this->db->query("SET NAMES UTF8");
	}
	
	final public function query($query, $crud = 'r', $return_id = false){
		
		$result = $this->db->query($query); // если запрос пришел методом read, сформировать то что в $result
		
		if($this->db->affected_rows === - 1){ // если ошибка на сервере
			throw new DbException('Ошибка в SQL запросе:' .  $query . ' - ' . $this->db->errno . ' ' . $this->db->error);
	
		}
		
		switch($crud){
			
			case 'r':
			
				if($result->num_rows){ // если что то пришло из базы
					
					$res = [];
					
					for($i = 0; $i < $result->num_rows; $i++){
						$res[] = $result->fetch_assoc(); //вернет масив каждого ряда выборки
					}
					
					return $res;
				}
				
				return false;
			
				break;
				
			case 'c':	
			
				if($return_id) return $this->db->insert_id;
				
				return true;
				
				break;
			
			default:
				return true;
				
				break;
				
		}
	}

    /**
     * @param $table - Таблици базы данных
     * @param array $set
     * 'fields' => ['id', 'name'], // какие поля
     * 'where' => ['name' => 'masha', 'surname' => 'Sergeevna', 'fio' => 'Andrey', 'car' => 'Porshe', 'color' => $color], // Где
     * 'operand' => ['IN', 'LIKE%', '<>', '=', 'NOT IN'],   //какой аператнд использовать не равно или равно единице, по умолчанию (=)
     * 'condition' => ['AND', 'OR'],  // по каким елементам будет обьединять
     * 'order' => ['fio', 'name'], // по каким полям сортировать
     * 'order_direction' => ['DESK'], // направление сортировки
     * 'limit' => '1'
	 * 'join' => [
	 *		[
	 *			'table' => 'join_table1',
	 *			'fields' => ['id as j_id', 'name as j_name'],
	 *			'type' => 'left',
	 *			'where' => ['name' => 'sasha'],
	 *			'operand' => ['='],
	 *			'condition' => ['OR'],
	 *			'on' => ['id', 'parent_id'],
	 *			'group_condition' => 'AND'	
	 *		],
	 *		'join_table2' => [
	 *			'table' => 'join_table2',
	 *			'fields' => ['id as j2_id', 'name as j2_name'],
	 *			'type' => 'left',
	 *			'where' => ['name' => 'sasha'],
	 *			'operand' => ['='],
	 *			'condition' => ['AND'],
	 *			'on' => [
	 *				'table' => 'teachers',
	 *				'fields' => ['id', 'parent_id']
	 *			]
	 *		]
	 *	] 
    **/

	final public function get($table, $set = []){

	    $fields = $this->createFields($set, $table);

        $order = $this->createOrder($set, $table);

        $where = $this->createWhere($set, $table);
		
		if(!$where) $new_where = true; // если WHERE нет в строке запроса
			else $new_where = false;
			
        $join_arr = $this->createJoin($set, $table, $new_where);

        $fields .= $join_arr['fields']; //добавляем значение fields из масива
        $join = $join_arr['join']; //присваиваем значение join из масива
        $where .= $join_arr['where']; //присваиваем значение where из масива

        $fields = rtrim($fields , ','); // обрезаем запятую


        $limit = $set['limit'] ? 'LIMIT ' . $set['limit'] : '';


        $query = "SELECT $fields FROM $table $join $where $order $limit";
        exit($query);

        return $this->query($query);
    }
	
	protected function createFields($set, $table = false){
		
		$set['fields'] =  (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : ['*']; // если есть то он и будет если нет то выбрать все
		
		$table = $table ? $table . '.' : ''; // если есть то он и будет c точкой в конце если нет то пустая строка
		
		$fields = '';
		
		
		foreach ($set['fields'] as $field){
			$fields .= $table . $field . ','; // получится к примеру name.id
		}
		
		return $fields;
	}
	
	protected function createOrder($set, $table = false){
		
		$table = $table ? $table . '.' : ''; // если есть то он и будет c точкой в конце если нет то пустая строка
		
		$order_by = '';
		
		if(is_array($set['fields']) && !empty($set['fields'])){
			
			$set['order_direction'] =  (is_array($set['order_direction']) && !empty($set['order_direction'])) ? $set['order_direction'] : ['ASC']; // если есть то он и будет если нет то вібрать все
			
			$order_by = 'ORDER BY ';
			$direct_count = 0;
			
			foreach ($set['order'] as $order){
				if ($set['order_direction'][$direct_count]){
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
	
	protected function createWhere($set, $table = false, $instruction = 'WHERE')
    {

        $table = $table ? $table . '.' : ''; // если есть то он и будет c точкой в конце если нет то пустая строка

        $where = '';

        if (is_array($set['where']) && !empty($set['where'])) {

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

                    if (is_string($item) && strpos($item, 'SELECT') === 0) { //если в массиве масив
                        $in_str = $item;
                    } else {
                        if (is_array($item)) $temp_item = $item;
                        else $temp_item = explode(',', $item);

                        $in_str = '';

                        foreach ($temp_item as $v) {
                            $in_str .= "'" . addslashes(trim($v)) . "',";
                        }
                    }

                    $where .= $table . $key . ' ' . $operand . ' (' . trim($in_str, ',') . ') ' . $condition; //названиие таблици, где, IN (SELECT)


                } elseif (strpos($operand, 'LIKE') !== false) { // если строка LIKE есть

                    $like_template = explode('%', $operand); // если % будет перед то первій елемент масива пустота

                    foreach ($like_template as $lt_key => $lt) {
                        if (!$lt) { // если первый елемент пришол пустой , то есть перед LIKE стоит знак %
                            if (!$lt_key) { //
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
		
		if($set['join']){
			
			$join_table = $table;
			
			foreach($set['join'] as $key => $item){
				if(is_int($key)){// если єто числовой масив
					if(!$item['table']) continue; // если таблици нет продолжим 
						else $key = $item['table']; // запишем таблицу
				}
				
				if($join) $join .= ' '; // если есть JOIN запрос то контакетируем
				
				if($item['on']){

                    $join_fields = [];
					
					switch (2){
						
						case count($item['on']['fields']):
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
						else $join .= trim(strtoupper($item['type'])). 'JOIN '; // если есть то в верхний регист и конкатенируем
						
					$join .= $key . ' ON ';

					if($item['on']['table']) $join .= $item['on']['table']; //если таблица существует то должны пристыковать таблица
						else $join .= $join_table; // предыдущая таблица
						
					$join .= '.' . $join_fields[0] . '=' . $key . '.' . $join_fields[1]; //
					
					$join_table = $key;
					
					if($new_where){
						
						if($item['where']){ // если будет какое то условие
							$new_where = false;
						}
						
						$group_condition = 'WHERE';
						
					}else{
						$group_condition = $item['group_condition'] ? strtoupper($item['group_condition']) : 'AND';
					}
					
					$fields .= $this->createFields($key, $item);
					$where .= $this->createWhere($key, $item, $group_condition);
					
				}
			}
		}
		
		return compact('fields', 'join', 'where');
		
	}
}














