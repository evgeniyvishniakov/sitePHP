<?php

namespace core\base\settings;

use core\base\controllers\Singleton;
use core\base\settings\Settings;

/**
 * Настройки плагина
 */

Class ShopSettings{

    use Singleton;

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
        return self::getInstance()->$property;
    }
    /**
	* Шаблон  проектирования синглтон
    **/
    
    static private function getInstance(){
		
		if(self::$_instance instanceof self){ // если здесь нет ошибок
			return self::$_instance; // вернем это свойство
        }

        self::instance()->baseSettings = Settings::instance(); //ссылка на обьект класса Settings
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
}