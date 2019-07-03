<?php


namespace core\base\models;

use core\base\controllers\Singleton;
use core\base\exceptions\DbException;

abstract class BaseModel extends BaseModelsMethods
{
	use Singleton;	
	
	protected $db;
	
	protected function connect(){
		
		$this->db = @new \mysqli(HOST, USER, PASS, DB_NAME); // подключение к базе данных
		
		if($this->db->connect_error){ // если в ошибке подключения что либо есть
		
			throw new DbException('Ошибка подключения к базе данных: ' 
				. $this->db->connect_errno . ' '.  $this->db->connect_error); // записываем сообщение об ошибке
		}
		
		$this->db->query("SET NAMES UTF8");
	}
	
	/**
	* @param @query 
	* @param string $crud = r - SELECT / с - INSERT / u - UPDATE / d - DELET
	* @param bool $return_id
	* @param array|bool|mixed
	* @param DbException
	*/
	
	final public function query($query, $crud = 'r', $return_id = false){
		
		$result = $this->db->query($query); // Запрос
		
		if($this->db->affected_rows === - 1){ // если ошибка на сервере
			throw new DbException('Ошибка в SQL запросе: ' 
			. $query . ' - ' . $this->db->errno . ' ' . $this->db->error
			);	
		}
		
		switch($crud){ // что же у нас находится в переменной crud
			
			case 'r': // чтение
			
				if($result->num_rows){ // если что то пришло из базы данніх
					
					$res = [];
					
					for($i = 0; $i < $result->num_rows; $i++){
						$res[] = $result->fetch_assoc(); //вернет масив каждого ряда выборки
					}
					
					return $res;
				}
				
				return false;
			
				break;
				
			case 'c': // редактирование	
			
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

        return $this->query($query);
    }
	
	/**
	* @param @table - таблица для вставки данных
	* @param array $set - массив параметров;
	* fields => [поле => значение]; если не указан, то обрабатывается $_POST[поле => значение]
	* разрешена передача например функций NOW() в качестве Mysql функции обычной строкой
	* files => [поле => значение]; можно подать массив вида [ поле => [масив значений]]
	* except => ['исключение 1','исключение 2'] - исключает данные еслементы массива из добавления в запрос
	* return_id => true|false - возвращать или нет идентификатор вставленной записи
	* return mixid
	*/
	
	final public function add($table, $set = []){
		
		
		$set['fields'] = (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : $_POST;
		$set['files'] = (is_array($set['files']) && !empty($set['files'])) ? $set['files'] : false;
		
		if(!$set['fields'] && !$set['files']) return false; //если нет никаких данных то прекращаем работу скрипта
		
		$set['return_id'] = $set['return_id'] ? true : false;
		$set['except'] = (is_array($set['except']) && !empty($set['except'])) ? $set['except'] : false;
	
		$insert_arr = $this->createInsert($set['fields'], $set['files'], $set['except']);
		
		
		
		if($insert_arr){
			
		$query = "INSERT INTO $table ({$insert_arr['fields']}) VALUES ({$insert_arr['values']})";
			
			return $this->query($query, 'c', $set['return_id']);
		}
		
		return false;
	}
	
	final public function edit($table, $set = []){
		
		$set['fields'] = (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : $_POST;
		$set['files'] = (is_array($set['files']) && !empty($set['files'])) ? $set['files'] : false;
		
		if(!$set['fields'] && !$set['files']) return false; //если нет никаких данных то прекращаем работу скрипта
		
		$set['except'] = (is_array($set['except']) && !empty($set['except'])) ? $set['except'] : false;
		
		if(!$set['all_rows']){
			
			if($set['where']){
				$where = $this->createWhere($set);
			}else{
				$columns = $this->showColumns($table);
				
				if(!$columns) return false;
				
				if($columns['id_row'] && $set['fields'][$columns['id_row']]){
					$where = 'WHERE ' . $columns['id_row'] . '=' . $set['fields'][$columns['id_row']];
					unset($set['fields'][$columns['id_row']]);
				}
			}
		}
		
		$udate = $this->createUpdate($set['fields'], $set['files'], $set['except']);
		
		$query = "UPDATE $table SET $udate $where";
		
		return $this->query($query, 'u');
		
	}

    /**
     * @param $table - Таблици базы данных
     * @param array $set
     * 'fields' => ['id', 'name'], // какие поля
     * 'where' => ['name' => 'masha', 'surname' => 'Sergeevna', 'fio' => 'Andrey', 'car' => 'Porshe', 'color' => $color], // Где
     * 'operand' => ['IN', 'LIKE%', '<>', '=', 'NOT IN'],   //какой аператнд использовать не равно или равно единице, по умолчанию (=)
     * 'condition' => ['AND', 'OR'],  // по каким елементам будет обьединять
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

    public function delete($table, $set){

	    $table = trim($table);

	    $where = $this->createWhere($set, $table);

	    $columns = $this->showColumns($table);
	    if(!$columns) return false;

	    if(is_array($set['fields']) && !empty($set['fields'])){

	        if($columns['id_row']){
	            $key = array_search($columns['id_row'], $set['fields']);
	            if($key !== false) unset($set['fields'][$key]);
            }

            $fields = [];

	        foreach($set['fields'] as $field){
	            $fields[$field] = $columns[$field]['Default'];
            }

            $update = $this->createUpdate($fields, false, false);

            $query = "UPDATE $table SET $update $where";
        }else{

	        $join_arr = $this->createJoin($set, $table);
	        $join = $join_arr['join'];
	        $join_tables = $join_arr['tables'];

	        $query = 'DELETE ' . $table . $join_tables . ' FROM ' . $table . ' ' . $join . ' ' . $where;

        }
        return $this->query($query, 'u');
    }

	
	final public function showColumns($table){
		
		$query = "SHOW COLUMNS FROM $table";
		$res = $this->query($query);
		
		$columns = [];
		
		if($res){
			
			foreach($res as $row){
				$columns[$row['Field']] = $row; // то что в Field  будет название масива а не число
				if($row['Key'] === 'PRI') $columns['id_row'] = $row['Field'];
			}
			
		}
		
		return $columns;
		
	}
}













