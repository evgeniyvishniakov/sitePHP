<?php
/**
 * Вытаскивает данные выводит виды
**/

namespace core\base\controllers;


use core\base\exceptions\RouteException;
use core\base\settings\Settings;

abstract class BaseController{ // не сможем создать обьект данного скласа

    use \core\base\controllers\BaseMethods;

	protected $page;
	protected $errors;
	
    protected $controller;
    protected $inputMethod; //входные методы
    protected $outputMethod; //выходные методы
    protected $parameters; // параметры методов


    protected $styles; //стили css
    protected $scripts; // скрипты js


    public function route(){ // метод маршрутов
		
        $controller = str_replace('/', '\\', $this->controller);

        try{ // если не создастся обьект сгенерируется исключение или нельзя будет вызвать обьект

            $object = new \ReflectionMethod($controller, 'request'); //создаем обьект класса

            $args = [  // массив аргументов с параметрами адресной строки
                'parameters' => $this->parameters,
                'inputMethod' => $this->inputMethod, //входной
                'outputMethod' => $this->outputMethod //выходной
            ];

            $object->invoke(new $controller, $args); //вызываем метод request на исполнение

        }catch (\ReflectionException $e){

            throw new RouteException($e->getMessage());

        }

    }


    public function request($args){
		
		$this->parameters = $args['parameters'];
		
		$inputData = $args['inputMethod'];
		$outputData = $args['outputMethod'];
		
		$data = $this->$inputData();
		
		if(method_exists($this, $outputData)){ //если метод в данном классе существует
		
			$page = $this->$outputData($data); // записываем
			if($page) $this->page = $page; //если существует то запишем в this
		
		}elseif ($data){
			$this->page = $data; // если данные существуют то заполняем
		}
		
		if($this->errors){ // если есть ошибка
			$this->writeLog($this->errors); //записываем в переменную ошибки и передаем в логи
		}
		
		$this->getPage();
		
    }
	
	protected function render($path = '', $parameters = []){
		
		
		extract($parameters); // создает переменные вида клюк значение из масива
		
		if(!$path){//если путь не пришел
		
			$class = new \ReflectionClass($this); // в переменной находится обьект класса
			$space = str_replace('\\', '/', $class->getNamespaceName() . '\\'); // переобразовуем слеши для неймспейсов
			$routes = Settings::get('routes');
			
			if($space === $routes['user']['path']) $template = TEMPLATE; //если пространство имен юзера то шаблон
			else $template = ADMIN_TEMPLATE; // в противном случаи шаблон админ панели
		
			$path = $template . explode('controller', strtolower($class->getShortName()))[0]; //то шаблон по дефолту
		}
			
		
		ob_start(); // буфер обмена

		if(!@include_once $path . '.php') throw new RouteException('Отсутствует шаблон - ' . $path ); // если шаблон не существует
			
		return ob_get_clean(); // вернет то что находится в буфере после чего зактроет буфер
			
	}

	protected function getPage(){
		
		if(is_array($this->page)) {//если это массив, то выведем каждый елемент масива последовательно
			foreach($this->page as $block) echo $block;
		}else{ //если это строка 
			echo $this->page;
		}
		
		exit();
		
	}

    protected function init($admin = false){ //Инициализирует стили и скрипты

        if (!$admin) { //если это не админка то подключаем для юзера
            if (USER_CSS_JS['styles']) { // проверяем на массив стили
                foreach (USER_CSS_JS['styles'] as $item) $this->styles[] = PATH . TEMPLATE . trim($item, '/'); //получаем значение с массива указіваем путь и обрезаем слеши в конце

            }
            if (USER_CSS_JS['scripts']) { // проверяем на массив скрипты
                foreach (USER_CSS_JS['scripts'] as $item) $this->scripts[] = PATH . TEMPLATE . trim($item, '/'); //получаем значение с массива указіваем путь и обрезаем слеши в конце

            }
        }else{ //в противном случае для админки
            if (ADMIN_CSS_JS['styles']) { // проверяем на массив стили
                foreach (ADMIN_CSS_JS['styles'] as $item) $this->styles[] = PATH . ADMIN_TEMPLATE . trim($item, '/'); //получаем значение с массива указіваем путь и обрезаем слеши в конце

            }
            if (ADMIN_CSS_JS['scripts']) { // проверяем на массив скрипты
                foreach (ADMIN_CSS_JS['scripts'] as $item) $this->scripts[] = PATH . ADMIN_TEMPLATE . trim($item, '/'); //получаем значение с массива указіваем путь и обрезаем слеши в конце

            }
        }
    }

}

















