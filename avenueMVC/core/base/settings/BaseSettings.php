<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 01.09.19
 * Time: 10:25
 */

namespace core\base\settings;

use core\base\controllers\Singleton;
use core\base\settings\Settings;

trait BaseSettings
{

    use Singleton{
        instance as SingletonInstance;
    }

    private $baseSettings;

    static public function get($property){
        return self::instance()->$property;
    }
    /**
     * Шаблон  проектирования синглтон
     **/

    static private function instance(){

        if(self::$_instance instanceof self){ // если здесь нет ошибок
            return self::$_instance; // вернем это свойство
        }

        self::SingletonInstance()->baseSettings = Settings::instance(); //ссылка на обьект класса Settings
        $baseProperties = self::$_instance->baseSettings->clueProperties(get_class()); // вызываем метод склеивания массивов шаблонов для плагинов и проекта
        self::$_instance->setProperty($baseProperties);

        return self::$_instance; // вернет свойство
    }

    protected function setProperty($properties){
        if (!$properties) {
            foreach ($properties as $name => $property) {
                $this->$name = $property;
            }
        }
    }

}