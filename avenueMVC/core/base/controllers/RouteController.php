<?php

/**
* Настройка маршрутов 
**/

namespace core\base\controllers;

use core\base\exceptions\RouteException;
use core\base\settings\Settings;

class RouteController extends BaseController {

    use Singleton; // подключаем трейт синглтон

	protected $routes;


	public function __construct(){	

		$adress_str = $_SERVER['REQUEST_URI']; //получкем адресную строку

		$path = substr($_SERVER['PHP_SELF'], 0 , strpos($_SERVER['PHP_SELF'], 'index.php'));// /dir/index.php

		if ($path === PATH) {

            if ( strrpos($adress_str, '/') === strlen($adress_str) - 1 &&
                 strrpos($adress_str, '/') !== strlen(PATH - 1) ) { //если есть символ в конце строики и этот символ не указывает не корень сайта

                $this->redirect(rtrim($adress_str, '/'), 301); // удаляем в конце символа пробелы
            }
			
			$this->routes = Settings::get('routes'); // получаем списокмаршрутов

			if (!$this->routes) throw new RouteException('Отсутствуют маршруты в базовых настройках (RouteController)' , 1); //если маршрутов нет, ошибка

            $url = explode('/', substr($adress_str, strlen(PATH))); //розбиваем строку через слеш
			
			if ($url[0] && $url[0] === $this->routes['admin']['alias']) {  //если после / будет слово admin, проверяем (админ и плагин)

                array_shift($url); //уберем название плагина с массива url

				/**
				 * НАСТРОЙКА ПЛАГИНОВ
				 */

				if ($url[0] && is_dir($_SERVER['DOCUMENT_ROOT'] . PATH . $this->routes['plugins']['path'] . $url[0] )) { // если в юрл дериктория к плагину
					
					$plugin = array_shift($url); // извлекаем в переменную название плагина

					$pluginSettings = $this->routes['settings']['path'] . ucfirst($plugin . 'Settings'); // формируем путь к файлу настроек, первый символ названия плагина в верхнем регистре

					if(file_exists($_SERVER['DOCUMENT_ROOT'] . PATH . $pluginSettings . 'php')){ //если по заданому пути существует файл
						$pluginSettings = str_replace('/', '\\', $pluginSettings); // екранируем слеш, делаем полный нейм спейс для данного файла
						$this->routes = $pluginSettings::get('routes'); //перезаписываем свойство и вызываем данный класс через статическое свойство гет
					}

					$dir = $this->routes['plugins']['dir'] ? '/' . $this->routes['plugins']['dir'] . '/' : '/'; // если есть дериктория к плагину то запишем дерикторию если нет то запишем просто /
					$dir = str_replace('//', '/', $dir); // в дериктории к плагину двойные слеши заменяем на одинарные

					$this->controller = $this->routes['plugins']['path'] . $plugin . $dir; // путь к плагину/название плагина/дериктория к настройкам

					$hrUrl = $this->routes['plugins']['hrUrl']; // проверка включен ли чпу в плагинах

					$route = 'plugins'; // для кого создаем маршрут

				}else { //  если это не плагин 

				/**
				 * НАСТРОЙКА АДМИНКИ
				 */

					$this->controller = $this->routes['admin']['path']; // записываем путь к админке

					$hrUrl = $this->routes['admin']['hrUrl']; // проверка включен ли чпу в админке

					$route = 'admin'; // для кого создаем маршрут
				}

			}else{ // в противном случае это пользовательский вид

				/**
				 * НАСТРОЙКА ПОЛЬЗОВАТЕЛЬСКОЙ ЧАСТИ
				 */
                $url = explode('/', substr($adress_str, strlen(PATH)));

				$hrUrl = $this->routes['user']['hrUrl']; // делаем чпу для пользователя

				$this->controller = $this->routes['user']['path']; // путь к контроллеру для данного адреса 

				$route = 'user'; // для кого создаем маршрут

			}	

			$this->createRoute($route, $url); // маршрут для кого и какие ссылки

			if ($url[1]) { // если в первом елементе что то есть 
				
				$count = count($url); // посчитаем коичество символов в строке
				$key = '';

				if (!$hrUrl) { // если в строке не чпу
					$i = 1;
				}else {
					$this->parameters['alias'] = $url[1]; // работаем со второго елемента в строке то превый запишем в переменную
					$i = 2;
				}

				for ( ; $i < $count; $i++) { 
					if (!$key) { //если пустая не строка (ячейка масива),
                        $key = $url[$i];
                        $this->parameters[$key] = '';
					}else { // на следующей литерации цикла ключ уже не пустой 
                        $this->parameters[$key] = $url[$i]; // записывыем то что приходить
						$key = '';
					}
				}
			}
			
		}else { // если некоректный путь 
			
            throw new RouteException('Не корректная дериктория сайта', 1);
		}

	}

	private function createRoute($var, $arr){ // создаем маршрут

		$route = []; 

		if (!empty($arr[0])) { // если если приходят пустіе данные
			if ($this->routes[$var]['routes'][$arr[0]]) { // если существует название моршрута в самих маршрутах в Settings
				$route = explode('/', $this->routes[$var]['routes'][$arr[0]]); //перебираем маршрут контроллер/метод данных/метод видов
				
				$this->controller .= ucfirst($route[0] . 'Controller'); //переводим имя контроллера первый символ в верхний регистр и добавляем слово
			}else {
				$this->controller .= ucfirst($arr[0] . 'Controller'); //если в массиве есть только нулевой елемент, добавим только контроллер
			}
		}else {
			$this->controller .= $this->routes['default']['controller']; // если в масиве нет первого елемента то подклчаем дефолтые значения
		}

		$this->inputMethod = $route[1] ? $route[1] : $this->routes['default']['inputMethod']; //если в роуте что то есть то запишем то что есть, если пусто то запишем дефолтные значения
		$this->outputMethod = $route[2] ? $route[2] : $this->routes['default']['outputMethod'];

		return;
	}
	
}
?>