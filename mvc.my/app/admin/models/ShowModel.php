<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 05.09.19
 * Time: 21:48
 */

namespace admin\models;


use core\models\BaseModel;

class ShowModel extends BaseModel
{
    protected $data = [];

    public function getTable(){

        $sql = "SELECT TABLE_NAME 
                FROM INFORMATION_SCHEMA.TABLES 
                WHERE TABLE_SCHEMA = DATABASE()";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }

    }

    public function getListProducts($name_table){

        $sql = "SELECT * FROM $name_table WHERE id > 0";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }

    }
}