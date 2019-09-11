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
    protected $atributes = [];

    public function get($name){

        $sql = "SELECT * FROM $name";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()){
                $atributes[] = $row;
            }
            return $atributes;
        }

    }




    public function del($del){

        $sql = "DELETE FROM products WHERE id = '$del'";

        $this->connect()->query($sql);

    }
}