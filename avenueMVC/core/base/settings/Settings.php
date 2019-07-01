<?php

/**
 * Настройки маршрутизатор
**/


namespace core\base\settings;

use core\base\controllers\Singleton;

class Settings{

    use Singleton; // подключаем трейт синглтон

    private $routes = [
        'admin' => [
            'alias' => 'admin',
            'path' => 'core/admin/controllers/',
            'hrUrl' => false
        ],
        'settings' =>[
            'path' => 'core/base/settings/'
        ],
        'plugins' => [
            'path' => 'core/plugins/',
            'hrUrl' => false,
            'dir' => false
        ],
        'user' => [
            'path' => 'core/user/controllers/',
            'hrUrl' => true,
            'routes' => [
				'site' => 'index/hello'
            ]
        ],
        'default' => [
            'controller' => 'IndexController',
            'inputMethod' => 'inputData',
            'outputMethod' => 'outputData'
        ]
    ];

    private $expansion = 'core/admin/expansion/';

    private $defaultTable = 'teachers';

	private $projecTables = [
	    'teachers' => ['name' => 'Учителя', 'img' => 'pages.png'],
        'students' => ['name' => 'Студенты', 'img' => 'pages.png']

    ];

    private $teplateArr = [
        'text' => ['name', 'phone', 'adress'],
        'textarea' => ['content', 'keywords']
    ];

    private $blockNeedle = [
        'vg-rows' => [],
        'vg_img' => [],
        'vg-content' => []
    ];

    private $translate = [
        'name'=> ['Название', 'Не более 100 символов']
    ];

    static public function get($property){
        return self::instance()->$property;
    }


    public function clueProperties($class){

        $baseProperties = [];
        
        foreach ($this as $name => $item) {
            $property = $class::get($name);
            
            if (is_array($property) && is_array($item)) {

                $baseProperties[$name] = $this->arrayMergeRecursive($this->$name, $property);
                continue;
            }

            if (!$property) $baseProperties[$name] = $this->$name;
                
        }

        return $baseProperties;

    }
    /**
     * Метод который обьединяет функц возможности array_replace и array_merge 
     */

    public function arrayMergeRecursive(){
       
        $arrays = func_get_args();

        $base = array_shift($arrays);

        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (is_array($value) && is_array($base[$key])){
                    $base[$key] = $this->arrayMergeRecursive($base[$key], $value);
                }else {
                    if (is_int($key)) {
                        if (!in_array($value, $base)) array_push($base, $value);
                        continue;    
                    }
                    $base[$key] = $value;
                }
            }
        }

        return $base;
    }

}


?>