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
		
		if($this->db->affected_rows === -1){ // если ошибка на сервере
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
     * 'where' => ['id' => 1, 'name' => 'Masha'], // Где
     * 'operand' => ['=', '<>'],   //какой аператнд использовать не равно или равно единице, по умолчанию (=)
     * 'condition' => ['AND'],  // по каким елементам будет обьединять
     * 'order' => ['fio', 'name'], // по каким полям сортировать
     * 'order_direction' => ['ASC', 'DESK'], // направление сортировки
     * 'limit' => '1'
     */

	final public function get($table, $set = []){

	    $fields = $this->createFields($table, $set);
        $where = $this->createWhere($table, $set);

        $join_arr = $this->createJoin($table, $set);

        $fields .= $join_arr['fields']; //добавляем значение fields из масива
        $join = $join_arr['join']; //присваиваем значение join из масива
        $where = $join_arr['where']; //присваиваем значение where из масива

        $fields = rtrim($fields , ','); // обрезаем запятую

        $order = $this->createOrder($table, $set);

        $limit = $set['limit'] ? $set['limit'] : '';

        $query = "SELECT $fields FROM $table $join $where $order $limit";

        return $this->query($query);
    }

}














