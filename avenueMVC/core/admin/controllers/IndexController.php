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
            'where' => ['name' => "masha"], // Где
            //'operand' => ['IN', '<>'],   //какой аператнд использовать не равно или равно единице, по умолчанию (=)
            //'condition' => ['AND', 'OR'],  // по каким елементам будет обьединять
			'order' => ['name'], // по каким полям сортировать
            'order_direction' => ['DESC'], // направление сортировки
            'limit' => '1',
			'join' => [
				[
					'table' => 'join_table1',
					'fields' => ['id as j_id', 'name as j_name'],
					'type' => 'left',
					'where' => ['name' => 'sasha'],
					'operand' => ['='],
					'condition' => ['OR'],
					'on' => [
						'table' => 'teachers',
						'fields' => ['id', 'parent_id']
					]
				],
//				'join_table2' => [
//					'table' => 'join_table2',
//					'fields' => ['id as j2_id', 'name as j2_name'],
//					'type' => 'left',
//					'where' => ['name' => 'sasha'],
//					'operand' => ['='],
//					'condition' => ['AND'],
//					'on' => [
//						'table' => 'teachers',
//						'fields' => ['id', 'parent_id']
//					]
//				]
			]
        ]);

        exit ('I am admin panel');
    }

}