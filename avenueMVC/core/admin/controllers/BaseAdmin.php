<?php 

namespace core\admin\controllers;

use core\admin\models\Model;
use core\base\controllers\BaseController;
use core\base\exceptions\RouteException;
use core\base\settings\Settings;


abstract class BaseAdmin extends BaseController{

    protected $model;

    protected $table;
    protected $columns;
    protected $data;
    protected $foreignData;

    protected $adminPath;

    protected $menu;
    protected $title;
	
	protected $fileArray;

    protected $messages;

    protected $translate;
    protected $blocks = [];

    protected $templateArr;
    protected $formTemplates;
    protected $noDelete;

    protected function inputData(){

        $this->init(true); // скрипты

        $this->title = 'VG engine';

        if(!$this->model) $this->model = Model::instance(); // если еще не вызвана
        if(!$this->menu) $this->menu = Settings::get('projecTables');
        if(!$this->adminPath) $this->adminPath = PATH . Settings::get('routes')['admin']['alias'] . '/';

        if(!$this->templateArr) $this->templateArr = Settings::get('templateArr');
        if(!$this->formTemplates) $this->formTemplates = Settings::get('formTemplate');

        if(!$this->messages) $this->messages = include $_SERVER['DOCUMENT_ROOT'] . PATH . Settings::get('messages') . 'informationMessages.php';

        $this->sendNoCacheHeaders();
    }

    protected function outputData(){

        if(!$this->content){

            $args = func_get_arg(0);
            $vars = $args ? $args : [];

            //if(!$this->template) $this->template = ADMIN_TEMPLATE . 'show';

            $this->content = $this->render($this->template, $vars);

        }

        $this->header = $this->render(ADMIN_TEMPLATE . 'include/header');
        $this->footer = $this->render(ADMIN_TEMPLATE . 'include/footer');

        return $this->render(ADMIN_TEMPLATE . 'layout/default');

    }

    protected function sendNoCacheHeaders(){

        header("Last-Modified: " . gmdate("D, d m Y H:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Cache-Control: max-age=0");
        header("Cache-Control: post-check=0,pre-check=0");

    }

    protected function exectBase(){
        self::inputData();
    }

    protected function createTableData($settings = false){

        if(!$this->table){
            if($this->parameters) $this->table = array_keys($this->parameters)[0];
            else{
                if(!$settings) $settings = Settings::instance();
                $this->table = $settings::get('defaultTable');
            }
        }

        $this->columns = $this->model->showColumns($this->table);

        if(!$this->columns) new RouteException('Не найдены поля в таблице - ' . $this->table, 2);
    }

    protected function expansion($args = [], $settings = false){

        $filename = explode('_', $this->table); // создаем масив
        $className = '';

        foreach($filename as $item) $className .= ucfirst($item); // проходимся по масиву и первую букву названия таблиц с большой

        if(!$settings){
            $path = Settings::get('expansion');
        }elseif(is_object($settings)){
            $path = $settings::get('expansion');
        }else{
            $path = $settings;
        }

        $class = $path . $className . 'Expansion';

        if(is_readable($_SERVER['DOCUMENT_ROOT'] . PATH. $class . '.php')){

            $class = str_replace('/', '\\', $class);

            $exp = $class::instance();

            foreach ($this as $name => $value){
                $exp->$name = &$this->$name;
            }

            return $exp->expansion($args);

        }else{
            $file = $_SERVER['DOCUMENT_ROOT'] . PATH . $path . $this->table . '.php';

            extract($args);

            if(is_readable($file)) return include $file;
        }

        return false;

    }

    protected function createOutputData($settings = false){

        if(!$settings) $settings = Settings::instance();

        $blocks = $settings::get('blockNeedle');
        $this->translate = $settings::get('translate'); // получаем свойства с settings

        if(!$blocks || !is_array($blocks)){ //если пустой или не массив

            foreach ($this->columns as $name => $item){ //перебираем поля таблицы
                if($name === 'id_row') continue; //если в поле name будет id_row то ничего не делаем продолжаем литерацию

                if(!$this->translate[$name]) $this->translate[$name][] = $name; //если нет ключа то запишем названия колонок

                $this->blocks[0][] = $name; //в нулевой олемент запишем все поля таблицы
            }

            return;

        }

        $default = array_keys($blocks)[0]; // по дефолту будет срабатівать первое значение блоко

        foreach ($this->columns as $name => $item){
            if($name === 'id_row') continue; //если в поле name будет id_row то ничего не делаем продолжаем литерацию

            $insert = false; // флаг если пусто

            //пройтись по blocks  и проверить есть ли там какие то свойства которые мы хотим использовать использовать из бд
            foreach ($blocks as $block => $value){
                //существует ли в масиве block ключ, если нет то его создаем
                if(!array_key_exists($block, $this->blocks)) $this->blocks[$block] = [];

                if(in_array($name, $value)){ // если есть свойства
                    $this->blocks[$block][] = $name;
                    $insert = true; // вставка произошла
                    break;
                }

            }

            //произошла ли вставка?
            if(!$insert) $this->blocks[$default][] = $name; //если нет, то записіваем дефолтные свойства
            if(!$this->translate[$name]) $this->translate[$name][] = $name;

        }

        return;
    }

    protected function createRadio($settings = false){

        if(!$settings) $settings = Settings::instance();

        $radio = $settings::get('radio');

        if($radio){ // если если радио
            foreach($this->columns as $name => $item){ // то ищем его в колонке базы данных
                if($radio[$name]) { //если находим радио в колонке
                    $this->foreignData[$name] = $radio[$name];

                }
            }
        }
    }

    protected function checkPost($settings = false){ // проверка на давнные в POST

        if($this->isPost()){ //если в пост пришло что то
            $this->clearPostFields($settings);
            $this->table = $this->clearStr($_POST['table']); // получаем таблицу в переменную
            unset($_POST['table']); // чистим єти значения

            if($this->table){ //если что то пришло, таблица
                $this->createTableData($settings);
                $this->editData();
            }
        }
    }

    protected function addSessionData($arr = []){ //добавление в сессию результата
        if(!$arr) $arr = $_POST;

        foreach($arr as $key => $item){
            $_SESSION['res'][$key] = $item;
        }

        $this->redirect();

    }

    protected function countChar($str, $counter, $answer, $arr){ //проверка на количество символов 

        if(strlen($str) > $counter){ // если длинна строки больше заданой 

            $str_res = str_replace('$1', $answer, $this->messages['count']); //вырезаем, и заменяем на название поля
            $str_res = str_replace('$2', $counter, $str_res);// 

            $_SESSION['res']['answer'] = '<div class="error">' . $str_res . '</div>';
            $this->addSessionData($arr);
        }

    }


    protected function emptyFields($str, $answer, $arr = []){ //проверка на пустоту

        if(empty($str)){ // если строка пустая то формируем сообщение об ошибке и записуем в ссесию
            $_SESSION['res']['answer'] = '<div class="error">' . $this->messages['empty'] . ' ' .$answer. '</div>';
            $this->addSessionData($arr);
        }

    }

    protected function clearPostFields($settings, &$arr = []){
        if(!$arr) $arr = &$_POST; // записываем массив POST
        if(!$settings) $settings = Settings::instance(); // подключаем настройки

        $id = $_POST[$this->columns['id_row']] ?: false; // если не пришол id поля то false

        $validate = $settings::get('validation'); // получаем массив данных настроек правил проверок 
        if(!$this->translate) $this->translate = $settings::get('translate'); // получаем перевод полей

        foreach ($arr as $key => $item){ // перебираем масив POST
            if(is_array($item)){ // если это массив
                $this->clearPostFields($settings, $item); // запускаем рекурсию, перебираем масив 
            }else{

                if(is_numeric($item)){ // только из чисел ли состоит строка
                    $arr[$key] = $this->clearNum($item);
                }

                if($validate) {

                    if ($validate[$key]) { // если ключ существует 

                        if ($this->translate[$key]) { // если такой ключ существует в переводе
                            $answer = $this->translate[$key][0]; // записываем нулевой ключ
                        } else {
                            $answer = $key; // записываем то что пришло в пост
                        }

                        if ($validate[$key]['crypt']) {  
                            if ($id) {
                                if (empty($item)) {
                                    unset($arr[$key]);
                                    continue;
                                }

                                $arr[$key] = md5($item);
                            }
                        }

                        if ($validate[$key]['empty']) $this->emptyFields($item, $answer, $arr);

                        if ($validate[$key]['trim']) $arr[$key] = trim($item);

                        if ($validate[$key]['int']) $arr[$key] = $this->clearNum($item);

                        if ($validate[$key]['count']) $this->countChar($item, $validate[$key]['count'], $answer, $arr);
                    }
                }
            }
        }

        return true;
    }

    protected function  editData($returnId = false){

		$id = false;
		$method = 'add';
		
		if($_POST[$this->columns['id_row']]){ // если придет id
			$id = is_numeric($_POST[$this->columns['id_row']]) ?
				$this->clearNum($_POST[$this->columns['id_row']]) : // то подчистим
				$this->clearStr($_POST[$this->columns['id_row']]); // ли строка
			if($id){
				$where = [$this->columns['id_row'] => $id];
				$method = 'edit';
			}
		}
		
		foreach($this->columns as $key => $item){
			if($key === 'id_row') continue;
			
			if($item['Type'] === 'date' || $item['Type'] === 'datetime'){
                !$_POST[$key] && $_POST[$key] = 'NOW()';
			}
		}
		
		$this->createFile();
		
		$this->createAlias($id);
		
		$this->updateMenuPosition();
		
		$except = $this->checkExceptFields();
		
		$res_id = $this->model->$method($this->table,[
			'files' => $this->fileArray,
			'where' => $where,
			'return_id' => true,
			'except' => $except
		]);
		
		if(!$id && $method === 'add'){ // если не пришел id в метод Add
			$_POST[$this->columns['id_row']] = $res_id;
			$answerSuccess = $this->messages['addSuccess'];
			$answerFail = $this->messages['addFail'];
		}else{ // в противносм случае edit
			$answerSuccess = $this->messages['editSuccess'];
			$answerFail = $this->messages['editFail'];
		}
		
		$this->expansion(get_defined_vars());
		
		$result = $this->checkAlias($_POST[$this->columns['id_row']]);
		
		if($res_id){
			$_SESSION['res']['answer'] = '<div class="success">' .$answerSuccess. '</div>';
			
			if(!$returnId) $this->redirect();
			
			return $_POST[$this->columns['id_row']];
			
		}else{
			
			$_SESSION['res']['answer'] = '<div class="error">' .$answerFail. '</div>';
			
			if(!$returnId) $this->redirect();
			
		}
    }
	
	protected function checkExceptFields(){
		
	}
	
	protected function createFile(){
		
	}
	
	protected function updateMenuPosition(){
		
	}
	
	protected function createAlias($id = false){
		
	}
	protected function checkAlias($id){
		
	}

}
















