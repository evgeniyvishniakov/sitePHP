<?php
/**
 * Вытаскивает данные выводит виды
**/

namespace core\base\controllers;


use core\base\exceptions\RouteException;

abstract class BaseController{ // не сможем создать обьект данного скласа

    protected $controller;
    protected $inputMethod; // собирает данные из базы данных
    protected $outputMethod; // отвечает за подключение видом
    protected $parameters;


    public function route(){
        $controller = str_replace('/', '\\', $this->controller);

        try{ // если не создастся обьект сгенерируется исключение или нельзя будет вызвать обьект

            $object = new \ReflectionMethod($controller, 'request'); //создаем обьект класса

            $args = [  // массив аргументов
                'parameters' => $this->parameters,
                'inputMethod' => $this->inputMethod,
                'outputMethod' => $this->outputMethod
            ];

            $object->invoke(new $controller, $args); //вызываем метод request на исполнение

        }catch (\ReflectionException $e){

            throw new RouteException($e);

        }

    }


    public function request($args){

    }

}