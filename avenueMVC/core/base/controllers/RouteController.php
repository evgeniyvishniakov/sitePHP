<?php

namespace core\base\controllers;

use core\base\exceptions\RouteException;
use core\base\settings\Settings;

class RouteController extends BaseController {

    use Singleton; // подключаем трейт синглтон

	protected $routes;


	public function __construct(){	

		$adress_str = $_SERVER['REQUEST_URI']; //получкем адресную строку

		if ( strrpos($adress_str, '/') === strlen($adress_str) - 1 && strrpos($adress_str, '/') !== 0 ) { //если символ в конце строики и это не корень сайта
			$this->redirect(rtrim($adress_str, '/'), 301); //перенаправляем на страницу без символа /
		}

		$path = substr($_SERVER['PHP_SELF'], 0 , strpos($_SERVER['PHP_SELF'], 'index.php'));// /dir/index.php

		if ($path === PATH) {

			$this->routes = Settings::get('routes');

			if (!$this->routes)throw new RouteException('Отсутствуют маршруты в базовых настройках (RouteController)' , 1); //если роутов нет, получаем исключение

            $url = explode('/', substr($adress_str, strlen(PATH))); //адресную строку обрезать с первого символа
			
			if ($url[0] && $url[0] === $this->routes['admin']['alias']) {  //если после / будет только слово admin

				//$url = explode('/', substr($adress_str, strlen(PATH . $this->routes['admin']['alias']) + 1 )); //обрезаем слово admin и после него строка контроллер и т.д

                array_shift($url); //уберем название плагина с массива url

				/**
				 * НАСТРОЙКА ПЛАГИНОВ
				 */

				if ($url[0] && is_dir($_SERVER['DOCUMENT_ROOT'] . PATH . $this->routes['plugins']['path'] . $url[0] )) { // если что то в юрл и существет дериктория к плагину то ищем плагин по заданому пути в настройках
					
					$plugin = array_shift($url); //уберем название плагина с массива url

					$pluginSettings = $this->routes['settings']['path'] . ucfirst($plugin . 'Settings'); // формируем имя к файлу настроек для плагина

					if(file_exists($_SERVER['DOCUMENT_ROOT'] . PATH . $pluginSettings . 'php')){ //если по заданому пути существует файл
						$pluginSettings = str_replace('/', '\\', $pluginSettings); // екранируем слеш, делаем полный нейм спейс
						$this->routes = $pluginSettings::get('routes'); //перезаписываем свойство и вызываем данный класс через статическое свойство гет
					}

					$dir = $this->routes['plugins']['dir'] ? '/' . $this->routes['plugins']['dir'] . '/' : '/'; // если этот елемент сущестут то запишем в dir / и имя директории в противном случае будет просто /
					$dir = str_replace('//', '/', $dir); //если двойные слеши заменяем на один

					$this->controller = $this->routes['plugins']['path'] . $plugin . $dir; // нас перебрасывает в плагин

					$hrUrl = $this->routes['plugins']['hrUrl']; // проверка включен ли чпу в плагинах

					$route = 'plugins'; // для кого создаем маршрут

				}else { //  если это не плагин 

				/**
				 * НАСТРОЙКА АДМИНКИ
				 */

					$this->controller = $this->routes['admin']['path']; // нас перебрасывает в админку

					$hrUrl = $this->routes['admin']['hrUrl']; // проверка включен ли чпу в админке

					$route = 'admin'; // для кого создаем маршрут
				}

			}else{

				/**
				 * НАСТРОЙКА ПОЛЬЗОВАТЕЛЬСКОЙ ЧАСТИ
				 */

			
				$hrUrl = $this->routes['user']['hrUrl']; // делаем чпу для пользователя

				$this->controller = $this->routes['user']['path']; // путь к контроллеру для данного адреса 

				$route = 'user'; // для кого создаем маршрут

			}	

			$this->createRoute($route, $url); // маршрут для кого и какие ссылки

			if ($url[1]) { // если в первом елементе что то есть то можем что то делать если нет свойство параметра будет пустое
				
				$count = count($url); // посчитаем коичество символов в строке
				$key = '';

				if (!$hrUrl) { // если в строке не чпу
					$i = 1;
				}else {
					$this->parameters['alias'] = $url[1]; // если работаем со второго елемента в строке то превый запишем в переменную
					$i = 2;
				}

				for ( ; $i < $count; $i++) { 
					if (!$key) { //если пустая строка (ечейка масива)
						$key = $url[$i]; 
						$this->parameters[$key] = ''; 
					}else { // на следующей литерации цикла ключ уже не пустой 
						$this->parameters[$key] = $url[$i]; // записывыем то что приходить 
						$key = '';
					}
				}
			}
			
		}else {
            throw new RouteException('Не корректная дериктория сайта', 1);
		}

	}

	private function createRoute($var, $arr){ // создаем маршрут

		$route = [];

		if (!empty($arr[0])) { // если елемент не пуст
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