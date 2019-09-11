<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 16.08.19
 * Time: 15:19
 */

namespace user\models;

use core\models\BaseModel;


class CatalogModel extends BaseModel{

    protected function get($name_table){

        $sql = "SELECT * FROM $name_table ";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()){
                $atributes[] = $row;
            }
            return $atributes;
        }

    }



}