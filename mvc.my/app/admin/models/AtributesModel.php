<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 07.08.19
 * Time: 11:37
 */

namespace admin\models;


use core\models\BaseModel;

class AtributesModel extends BaseModel
{
    protected $data = [];

    public function get($name){

        $sql = "SELECT * FROM $name";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }

    }

    public function add($insert){


        $sql = "INSERT INTO products SET $insert ";

        $this->connect()->query($sql);

    }

    public function del($del){

        $sql = "DELETE FROM products WHERE id = '$del'";

        $this->connect()->query($sql);

    }
}