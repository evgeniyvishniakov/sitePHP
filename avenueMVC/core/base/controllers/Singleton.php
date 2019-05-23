<?php


namespace core\base\controllers;


trait Singleton{

    static private $_instance;

    private function __construct(){
    }

    private function __clone(){
    }

    static public function instance(){
        if(self::$_instance instanceof self){ // если хранится обьект нашего класа самого себя
            return self::$_instance; // вернем это свойство
        }

        return self::$_instance = new self; // все равно вернет свойство
    }

}