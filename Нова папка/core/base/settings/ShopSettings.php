<?php

namespace core\base\settings;

use core\base\settings\Settings;

/**
 * Настройки плагина
 */

Class ShopSettings{

    static private $_instance;
    private $baseSettings;

    private $routes = [
        'plugins' => [
            'dir' => false,
            'routes' => [

            ]
        ],
    ];

    private $templateArr = [
        'text' => ['price', 'short'],
        'textarea' => ['goods_content']
    ];

    static public function get($property){
        return self::instance()->$property;
    }
    /**
	* Шаблон  проектирования синглтон
    **/
    
    static public function instance(){
		
		if(self::$_instance instanceof self){ // если хранится обьект нашего класа самого себя
			return self::$_instance; // вернем это свойство
        }
        
        self::$_instance = new self; // записать 
        self::$_instance->baseSettings = Settings::instance(); //ссылка на обьект класса Settings
        $baseProperties = self::$_instance->baseSettings->clueProperties(get_class()); // вызываем метод склеивания массивов шаблонов для плагинов и проекта
        self::$_instance->setProperty($baseProperties);
        return self::$_instance; // все равно вернет свойство
    }

    protected function setProperty($properties){
        if (!$properties) {
            foreach ($properties as $name => $property) {
                $this->$name = $property;
            }
        }
    }

    private function __construct(){
    }

    private function __clone(){   
    }
}