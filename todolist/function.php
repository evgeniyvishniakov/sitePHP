<?php
include_once "connection.php";



function FunctionCheckTask($str){ // Проверка на введенные данные

	$notcorrectsymbolTwo = "!@\"#№;$%^:&?*()//|\\`.,";
	$reg = "/[а-Я]/";
	$bool = false;
	for ($i = 0; $i < strlen($str); $i++) {

		for ($j = 0; $j < strlen($notcorrectsymbolTwo); $j++) 
			if ($str[$i] == $notcorrectsymbolTwo[$j])
				$bool = true;
		}

		if ($bool != true) {

			if (!preg_match($reg, $str)){
					return true;}
			else{
				return false;}
		}
		else{ 
			return false;}
 }

?>