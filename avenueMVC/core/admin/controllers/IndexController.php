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
use core\base\settings\Settings;

class IndexController extends BaseController {

    protected function inputData(){

        $redirect = PATH. Settings::get('routes')['admin']['alias'] . '/show';
        $this->redirect($redirect);

    }

}