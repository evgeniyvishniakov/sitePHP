<?php

/**
* Настройка маршрутов 
**/




class RouteController{

	private $routes_admin = ['categories','users','products','atributes', 'show', 'add','addatribute'];
	private $routes_user = ['contacts','catalog','login','logout','register','cart'];

    public $views;
    public $name_table;

	public function __construct(){	

		$adress_str = $_SERVER['REQUEST_URI'];

        if($_SERVER['QUERY_STRING']){ 
            $adress_str = substr($adress_str, 0, strpos($adress_str, $_SERVER['QUERY_STRING']) - 1);
		}

		$path = substr($_SERVER['PHP_SELF'], 0 , strpos($_SERVER['PHP_SELF'], 'index.php'));


		if ($path === '/') {

            $url = explode('/', substr($adress_str, strlen('/'))); //розбиваем строку через слеш

			if ($url[0] === 'admin') {  //если после / будет слово admin

                if ($_SESSION['auth'] == 1) {

                    if (!$url[1]) {

                        header('Location: http://mvc.my/admin/show?table=tires');

                    }

                    if ($url[0] === 'admin'&& $url[1]) {

                        if (array_search($url[1], $this->routes_admin)) {

                            if (file_exists('./app/admin/controllers/' . ucfirst($url[1]) . 'Controller.php')) {

                                $path_view = 'admin\controllers\\' . ucfirst($url[1]) . 'Controller';
                                $this->views = new $path_view($url[1]);
                                $this->views->render();

                            }

                        } else {

                            include_once './404.php';

                        }

                    }
                }else{

                    header('Location: http://mvc.my/login');
                    ob_end_flush();
                    exit;

                }

            }elseif($url[0] !== 'admin'){

				if($url[0] === ''){
					
					include_once './app/user/views/home.php';

                }
				
				if ($url[0]) {

                    if (array_search($url[0], $this->routes_user)) {

                        if (file_exists('./app/user/controllers/' . ucfirst($url[0]) . 'Controller.php')) {

                            $path_view = 'user\controllers\\' . ucfirst($url[0]) . 'Controller';
                            $this->views = new $path_view($url[0]);
                            $this->views->render();

                        }

                    } else {

                        include_once './404.php';

                    }
				}	

			}else{

				include_once './404.php';

			}
		}
	}
}				


















