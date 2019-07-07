<?php


namespace core\admin\controllers;


use core\base\settings\Settings;


class AddController extends BaseAdmin
{

    protected function inputData(){

        if(!$this->userId) $this->exectBase();

        $this->createTableData();

        $this->createForeignData();

        $this->createMenuPosition();

        $this->createRadio();

        $this->createOutputData();

        $this->manyAdd();

        exit;

    }

    protected function manyAdd(){

        $fields = ['name' => 'Nata'];
        $files = ['img' => '1.jpg'];

        $this->model->add('teachers',[
          'fields' => $fields,
          'files' => $files
        ]);
    }

    protected function createForeignProperty($arr, $rootItems){

        if(in_array($this->table, $rootItems['tables'])){
            $this->foreignData[$arr['COLUMN_NAME']][0]['id'] = 0; //текущаее поле таблиці которое ссылается
            $this->foreignData[$arr['COLUMN_NAME']][0]['name'] = $rootItems['name'];
        }

        $columns = $this->model->showColumns($arr['REFERENCED_TABLE_NAME']);

        $name = '';

        if ($columns['name']) { // если в колонке есть поле name
            $name = 'name'; // то в переменную запишем
        }else{
            foreach ($columns as $key => $values){ // перебираем колонки
                if(strpos($key, 'name') !== false){ //если в
                    $name = $key . 'as name';
                }
            }

            if(!$name) $name = $columns['id_row'] . ' as name';

        }

        if($this->data){
            if($arr['REFERENCED_TABLE_NAME'] === $this->table){ //если ссылается на себя
                $where[$this->columns['id_row']] = $this->data[$this->columns['id_row']];
                $operand[] = '<>';
            }
        }

        $foreign = $this->model->get($arr['REFERENCED_TABLE_NAME'],[
            'fields' =>[$arr['REFERENCED_COLUMN_NAME'] . ' as id', $name],
            'where' => $where,
            'operand' => $operand
        ]);

        if($foreign){

            if($this->foreignData[$arr['COLUMN_NAME']]){ //если в ней уже что то лежит
                foreach ($foreign as $value){
                    $this->foreignData[$arr['COLUMN_NAME']][] = $value;
                }
            }else{
                $this->foreignData[$arr['COLUMN_NAME']] = $foreign;
            }
        }
    }

    protected function createForeignData($settings = false){

        if(!$settings) $settings = Settings::instance();

        $rootItems = $settings::get('rootItems'); //Получаем свойства

        $keys = $this->model->showForeignKeys($this->table);

        if($keys){
            foreach ($keys as $item){

                $this->createForeignProperty($item, $rootItems);

            }
        }elseif($this->columns['parent_id']){ // если есть ячейка parent_id

            $arr['COLUMN_NAME'] = 'parent_id';
            $arr['REFERENCED_COLUMN_NAME'] = $this->columns['id_row'];
            $arr['REFERENCED_TABLE_NAME'] = $this->table;

            $this->createForeignProperty($arr, $rootItems);
        }

        return;

    }

    protected function createMenuPosition($settings = false){

        if($this->columns['menu_position']){ //если в талице есть поле menu_position

            if(!$settings) $settings = Settings::instance(); // записываем настройки
            $rootItems = $settings::get('rootItems'); // получаем настройки

            if ($this->columns['parent_id']){ // если есть колонка parent_id

                if(in_array($this->table, $rootItems['tables'])){

                    $where = 'parent_id IS NULL OR parent_id = 0';

                }else{

                    $parent = $this->model->showForeignKeys($this->table, 'parent_id')[0];

                    if($parent){

                        if($this->table === $parent['REFERENCED_TABLE_NAME']){
                            $where = 'parent_id IS NULL OR parent_id = 0';
                        }else{

                            $columns = $this->model->showColumns($parent['REFERENCED_TABLE_NAME']);

                            if($columns['parent_id']) $order[] = 'parent_id';
                            else $order[] = $parent['REFERENCED_COLUMN_NAME'];

                            $id = $this->model->get($parent['REFERENCED_TABLE_NAME'], [
                                'fields' => [$parent['REFERENCED_COLUMN_NAME']],
                                'order' => $order,
                                'limit' => '1'
                            ])[0][$parent['REFERENCED_COLUMN_NAME']];

                            if($id) $where = ['parent_id' => $id];

                        }

                    }else{

                        $where = 'parent_id IS NULL OR parent_id = 0';

                    }
                }
            }

            $menu_pos = $this->model->get($this->table, [
                    'fields' => ['COUNT(*) as count'],
                    'where' => $where,
                    'no_concat' => true
                ])[0]['count'] + 1;

            for($i = 1; $i <= $menu_pos; $i++){
                $this->foreignData['menu_position'][$i - 1]['id'] = $i;
                $this->foreignData['menu_position'][$i - 1]['name'] = $i;
            }

        }

        return;


    }


}