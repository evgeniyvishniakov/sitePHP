<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 16.08.19
 * Time: 17:43
 */

namespace user\controllers;


use core\models\BaseModelMethods;

class FilterController
{
    protected $getAtrib;

    public function Atribute($name_atribute){

        $this->getAtrib = new BaseModelMethods();
        return $this->getAtrib->getAtribute($name_atribute);
    }

}