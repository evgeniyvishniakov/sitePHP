<?php 

namespace admin\models;

use core\models\BaseModel;

class ProductsModel extends BaseModel
{


	public function get(){
		
		$sql = "SELECT * FROM products";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}

	}

	
	public function del($del){
		
		$sql = "DELETE FROM products WHERE id = '$del'";
		
		$this->connect()->query($sql);

	}
}