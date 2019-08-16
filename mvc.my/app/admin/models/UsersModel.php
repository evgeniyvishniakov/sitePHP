<?php 

namespace admin\models;

use core\models\BaseModel;

class UsersModel extends BaseModel
{
	protected $data = [];

	public function getUsers(){
		
		$sql = "SELECT * FROM register";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}

	}
}