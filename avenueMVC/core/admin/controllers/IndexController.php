<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 22.05.19
 * Time: 22:07
 */

namespace core\admin\controllers;


use core\base\controllers\BaseController;
use core\admin\models\Model;

class IndexController extends BaseController {

    protected function inputData(){


        $db = Model::instance();

        $tabel = 'teachers';
//        $res = $db->get($tabel,[ //первым параметром таблица, вторым масив
//
//            'fields' => ['id', 'name'], // какие поля
//            'where' => ['id' => 1, 'name' => 'Masha', 'surname' => 'Sergeevna'], // Где
//            'operand' => ['=', '<>'],   //какой аператнд использовать не равно или равно единице, по умолчанию (=)
//            'condition' => ['AND'],  // по каким елементам будет обьединять
//            'order' => ['fio', 'name'], // по каким полям сортировать
//            'order_direction' => ['ASC', 'DESK'], // направление сортировки
//            'limit' => '1'
//
//        ]);

        exit ('I am admin panel');
    }

}