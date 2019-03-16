<?php 
include_once 'class_connect.php';

class CategoriesAdd{

    private $parent_cat;
    private $child_cat;

    function __construct($parent_cat, $child_cat) {

		$this->parent_cat = htmlspecialchars($parent_cat);
    $this->child_cat = htmlspecialchars($child_cat);
		$this->maxLentgh = 20;
		$this->minLentgh= 4;
    }

    public function categoriesAdd(){ // основная ф-ия регистра , true - регистрация успешна - false - не успешна
	

		if ($this->checkCatBD()){
			return false;
		}
		else{	
			
			if ($this->checkСhild_cat()){
				
                if($this->addCategoriesDB())
					    return true;
					else 
						return false;
            } 
			else 
				{return false;}
		}
	}    

    public function addCategoriesDB(){ // Добавление в базу (дочерняя категория и идинтификатор родотельской)
	
		$connect = new connectBD();
		$connect->connect();

		$add = $connect->pdo->prepare("INSERT INTO categories (name, parents_cat) VALUES (?,?)");
		$add->execute(array($this->child_cat, $this->parent_cat));

		if ($add)
			return true;
		else false;

		$connect->closeConnect();
	}
    
    //public function checkParent_cat(){ // Проверка Родительской категории на регулярные выражения
	
	//	if(strlen($this->parent_cat) >= $this->minLentgh && strlen($this->parent_cat) <= $this->maxLentgh){

	//		$notcorrectsymbolTwo = "!@\"#№;$%^:&?*()-_+=//|\\`.,";
	//		$reg = "/[а-Я]/";
	//		$bool = false;
	//		for ($i = 0; $i < strlen($this->parent_cat); $i++) {

	//			for ($j = 0; $j < strlen($notcorrectsymbolTwo); $j++) 
	//				if ($this->parent_cat[$i] == $notcorrectsymbolTwo[$j])
	//					$bool = true;
	//		}

	//		if ($bool != true) {

	//			if (!preg_match($reg, $this->parent_cat))
	//					return true;
	//			else
	//				return false;
	//		}
	//		else 
	//			return false;
	//	}
	//	else
    //        return false;
    //}
    
    public function checkСhild_cat(){ // Проверка Дочерней категории на регулярные выражения
	
		if (strlen($this->child_cat) >= $this->minLentgh && strlen($this->child_cat) <= $this->maxLentgh){

			$notcorrectsymbolTwo = "!@\"#№;$%^:&?*()-_+=//|\\`.,";
			$reg = "/[а-Я]/";
			$bool = false;
			for ($i = 0; $i < strlen($this->child_cat); $i++) {

				for ($j = 0; $j < strlen($notcorrectsymbolTwo); $j++) 
					if ($this->child_cat[$i] == $notcorrectsymbolTwo[$j])
						$bool = true;
			}

			if ($bool != true) {

				if (!preg_match($reg, $this->child_cat))
						return true;
				else
					return false;
			}
			else 
				return false;
		}
		else
			return false;
    }

    private function checkCatBD(){ // Есть ли в базе категориия с таким названием
	
		$connect = new connectBD();
		$connect->connect();

		$query_1 = $connect->pdo->prepare("SELECT * FROM categories WHERE name = ?");
		$query_1->execute(array($this->child_cat));

		if (($row_1 = $query_1->fetch()) > 0)
			return true;
		else 
			return false;

		$connect->closeConnect();
	}
}
