<?php


namespace core\base\controllers;


trait BaseMethods
{

    protected function clearStr($str){ //очистка строки от тегов

        if(is_array($str)){ // если строка массив
            foreach ($str as $key => $item) $str[$key] = trim(strip_tags($str)); //перебираем массив и обрезаем теги
            return $str;
        }else{ // если это строка
            return trim(strip_tags($str));
        }
    }

    protected function clearNum($num){ //вывод тольк числа
        return $num * 1;
    }

    protected function isPost(){ //провертка на метод
        return $_SERVER['REQUEST_METHOD'] == 'POST'; // если так то поличим тру, нет то фолс
    }

    protected function isAjax(){ //проверка на ajax
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    protected function redirect($http = false, $code = false){ //проверка на перенаправление

        if($code){ // если переенная тру (тоесть ошибка)
            $codes = ['301'=> 'HTTP/1.1 301 Move Permanently']; // записываем в массив с ошибками

            if($codes[$code]) header($codes[$code]); //если в масиве существет ошибка то перенаправляем по ссылке
        }

        if($http) $redirect = $http; // если существет адресс записіваем в переменную
            else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;// если адресс равен серверу то запишем адресс или отправим на главную

            header("Location: $redirect"); // редиректим

            exit();

    }

    protected function writeLog($message, $file = 'log.txt', $event = 'Fault'){ //запись логов

        $dateTime = new \DateTime();

        $str = $event . ': ' . $dateTime->format('d-m-Y G:i:s') . ' - ' . $message . "\r\n"; //событие - время - сообщение

        file_put_contents('log/' . $file, $str, FILE_APPEND); // создаем файл и записываем с новой строки

    }

}














