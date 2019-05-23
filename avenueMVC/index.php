<?php

define('VG_ACCESS', true);

header("Content-Type: text/html; charset=utf-8");
mb_internal_encoding('UTF-8');
session_start();

require_once 'config.php'; // настройки для хостинга
require_once 'core/base/settings/internal_settings.php'; // настройки для проекта

use core\base\exceptions\RouteException;
use core\base\controllers\RouteController;


try{
	RouteController::instance()->route(); // возвращает ссылку на обьект класса
}
catch (RouteException $e){
	exit($e->getMessage());
}



?>