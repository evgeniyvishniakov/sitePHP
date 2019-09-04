<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 01.09.19
 * Time: 10:52
 */

namespace libraries;


class TextModify
{

    protected $translitArr = [ 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => 'y', 'ы' => 'y',
        'ь' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', ' ' => '-',

    ];

    protected $lowelLetter = ['а', 'е', 'и', 'о', 'у', 'э'];


    public function translit($str){

        $str = mb_strtolower($str);
        $temp_arr = [];

        for($i = 0; $i < mb_strlen($str); $i++){
            $temp_arr[] = mb_substr($str, $i, 1);
        }

        $link = '';

        if($temp_arr){
            foreach ($temp_arr as $key => $char){

                if(array_key_exists($char, $this->translitArr)){

                    switch($char){

                        case 'ъ':
                            if($temp_arr[$key+1]) $link .= 'y';
                            break;

                        case 'ы':
                            if($temp_arr[$key+1] == 'й') $link .= 'і';
                                else $link .= $this->translitArr[$char];
                                break;

                        case 'ь':
                            if($temp_arr[$key+1] !== count($temp_arr) && in_array($temp_arr[$key+1], $this->lowelLetter)){
                                $link .= $this->translitArr[$char];
                            }
                            break;

                        default:
                            $link .= $this->translitArr[$char];
                            break;

                    }

                }else{

                    $link .= $char;

                }

            }

        }

        if($link){

            $link = preg_replace('/[^a-z0-9_-]/iu', '', $link);
            $link = preg_replace('/-(2,)/iu','-', $link);
            $link = preg_replace('/_(2,)/iu','_', $link);
            $link = preg_replace('/(^[-_]+)|([-_]+$)/iu','', $link);
        }

        return $link;
    }

}