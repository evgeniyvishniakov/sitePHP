<?php
/*
 * Маршрутные исключения
 */


namespace core\base\exceptions;


use core\base\controllers\BaseMethods;


class RouteException extends \Exception{

    protected $messages;

    use BaseMethods; // подкочаем трейт в котором метод WriteLog()

    public function __construct($message = "", $code = 0){

        parent::__construct($message, $code);

        $this->messages = include 'messages.php'; // путь к файлу с ошибками

        $error = $this->getMessage() ? $this->getMessage() : $this->messages[$this->getCode()]; // приходит сообщение об ошибке

        $error .= "\r\n" . 'file ' . $this->getFile() . "\r\n" . 'In line ' . $this->getLine() . "\r\n"; // с новой строки имя файла и с новой строки линия ошибки

        if($this->messages[$this->getCode()]) $this->message = $this->messages[$this->getCode()]; // если существует ошибка

        $this->writeLog($error); // передаем сообщение ошибки для записи

    }

}