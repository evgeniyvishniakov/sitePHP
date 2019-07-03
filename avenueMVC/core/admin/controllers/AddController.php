<?php


namespace core\admin\controllers;


use core\base\settings\Settings;


class AddController extends BaseAdmin
{

    protected function inputData(){

        if(!$this->userId) $this->exectBase();

        $this->createTableData();

        $this->createForeignData();

        $this->createRadio();

        $this->createOutputData();

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


}