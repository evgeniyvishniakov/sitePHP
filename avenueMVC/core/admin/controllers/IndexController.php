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


        $res = $db->delete($table, [
            'where' => ['id' => 7],
            'join' => [
                [   'table' => 'students',
                    'on' => ['student_id', 'id']
                ]
            ]
        ]);

        exit('id =' . $res['id'] . ' Name = ' . $res['name']);
    }

}