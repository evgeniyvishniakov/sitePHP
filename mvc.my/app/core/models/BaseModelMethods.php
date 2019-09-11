<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 17.08.19
 * Time: 10:40
 */

namespace core\models;


class BaseModelMethods extends BaseModel
{

    public function add(){

        $sql = "INSERT INTO brands SET brands_value = 'test'";

        $this->connect()->query($sql);

    }
}