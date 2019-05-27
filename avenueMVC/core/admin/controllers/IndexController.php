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

        $table = 'teachers';

        $color = ['red', 'blue', 'black'];
		
        $res = $db->get($table, [ //первым параметром таблица, вторым масив

            'fields' => ['id', 'name'], // какие поля
            'where' => ['name' => 'masha', 'surname' => 'Sergeevna', 'fio' => 'Andrey', 'car' => 'Porshe', 'color' => $color], // Где
            'operand' => ['IN', 'LIKE%', '<>', '=', 'NOT IN'],   //какой аператнд использовать не равно или равно единице, по умолчанию (=)
            'condition' => ['AND'],  // по каким елементам будет обьединять
			'order' => ['fio', 'name'], // по каким полям сортировать
            'order_direction' => ['DESK'], // направление сортировки
            'limit' => '1'

        ]);

        exit ('I am admin panel');
    }

}