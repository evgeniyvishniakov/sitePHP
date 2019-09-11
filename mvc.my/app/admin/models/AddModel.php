<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 07.09.19
 * Time: 13:06
 */

namespace admin\models;


use core\models\BaseModel;

class AddModel extends BaseModel
{

    public function add($name_table, $insert)
    {
        $sql = "INSERT INTO $name_table SET $insert";

        $add = $this->connect()->query($sql);

        if($add)return true; return false;

    }
}
