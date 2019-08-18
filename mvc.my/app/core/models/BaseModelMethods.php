<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 17.08.19
 * Time: 10:40
 */

namespace core\models;
use core\models\BaseModel;

class BaseModelMethods extends BaseModel
{

    public function getAtribute($name)
    {

        $sql = "SELECT * FROM $name";
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