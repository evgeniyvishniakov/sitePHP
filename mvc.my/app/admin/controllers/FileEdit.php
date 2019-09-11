<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 06.09.19
 * Time: 14:26
 */

namespace admin\controllers;


class FileEdit
{

    protected $imgArr = [];
    protected $directory;

    public function addFile($directory = false){

        if(!$directory) $this->directory = 'app/userfile/';
            else $this->directory = $directory;

        foreach($_FILES as $key => $file){

            if(is_array($file['name'])){

                $file_arr = [];

                for($i = 0; $i < count($file['name']); $i++){

                    if(!empty($file['name'][$i])){

                        $file_arr['name'] = $file['name'][$i];
                        $file_arr['type'] = $file['type'][$i];
                        $file_arr['tmp_name'] = $file['tmp_name'][$i];
                        $file_arr['error'] = $file['error'][$i];
                        $file_arr['size'] = $file['size'][$i];

                        $res_name = $this->createFile($file_arr);

                        if($res_name) $this->imgArr[$key][] = $res_name;
                    }
                }

            }else{

                if($file['name']){

                    $res_name = $this->createFile($file);

                    if($res_name) $this->imgArr[$key] = $res_name;
                }

            }

        }

        return $this->getFiles();
    }

    protected function createFile($file){

        $fileNameArr = explode('.', $file['name']);
        $ext = $fileNameArr[count($fileNameArr) - 1]; //последний елемент массива
        unset($fileNameArr[count($fileNameArr) - 1]);

        $fileName = implode('.', $fileNameArr);

        //$fileName = (new TextModify())->translit($fileName);

        $fileName = $this->checkFile($fileName, $ext);

        $fileFullName = $this->directory . $fileName;

        if($this->uploadFile($file['tmp_name'], $fileFullName))
            return $fileName;

        return false;

    }

    protected function uploadFile($tmpName, $dest){

        if(move_uploaded_file($tmpName, $dest)) return true;

        return false;

    }

    protected function checkFile($fileName, $ext, $fileLastName = ''){

        if(!file_exists($this->directory . $fileName . $fileLastName . '.' . $ext))
            return $fileName . $fileLastName . '.' . $ext;

        return $this->checkFile($fileName, $ext, '_' . hash('crc32', time() . mt_rand(1, 1000)));
    }

    public function getFiles(){

        return $this->imgArr;

    }

}