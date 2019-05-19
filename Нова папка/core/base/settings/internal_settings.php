<?php

/*
 * Создание констанд и путей к файлам
 */

defined('VG_ACCESS') or die('Access denied');

const TEMPLATE = 'tamplate/default/'; // шаблон проекта по умолчанию 
const ADMIN_TEMPLATE = 'core/admin/views'; // шаблон админки по умолчанию 

const COOKIE_VERSION = '1.0.0'; // перелогинится пользователя
const CRYPT_REY = ''; // ключ шифрования
const COOKIE_TIME = 60; // время бездействия 
const BLOCK_TIME = 1; // система переборов паролей

const QTY = 8; // количество выводимых товаров
const QTY_LINES = 3; 

const ADMIN_CSS_JS = [ // пути к файлам для админ панели
		'styles' => [],
		'scripts' => []
];

const USER_CSS_JS = [ // пути к файлам для пректа
		'styles' => [],
		'scripts' => []
]; 



/**
* ипортируем пространство имен для конкретного класса RouteException
**/

use core\base\exceptions\RouteException; 

function autoloadMainClasses($class_name){
	
	$class_name = str_replace('\\', '/', $class_name);
	
	if(!@include $class_name . '.php'){ //@ - блокирует вывод ошибок если файл подключится не может
		throw new RouteException('Не верный путь файла для подключения -' . $class_name); // выбросить исключения
	}
	
}

spl_autoload_register('autoloadMainClasses');

?>