<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 12.08.19
 * Time: 14:36
 */

namespace user\models;

use core\models\BaseModel;

class LoginModel extends BaseModel{

    protected function AuthLogin($login){


        $sql = "SELECT * FROM register WHERE login = '$login'";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }

    }

    protected function AuthPass($pass){

        $sql = "SELECT * FROM register WHERE password = '$pass'";
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