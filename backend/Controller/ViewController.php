<?php
class ViewController {

	public static function backTemplate(){
		include "View/template.php";
	}

	public static function loadView(){
		$controller = null;
		// Si existe una sessión tendremos acceso al interior de la app
		if (Session::get('user')) {

			if(isset($_GET['c'])){
				// Obtiene el controlador a cargar
			    $controller = ucwords(strtolower($_GET['c'])). 'Controller';

			} else {
			    $controller = 'MainController';
			}

		} else {

			// Si no existe controlador o existe un controlador conocido cargara el login
			if(!isset($_GET['c']) ||
				strtolower($_GET['c']) == 'access' ||
				strtolower($_GET['c']) == 'main' ||
				strtolower($_GET['c']) == 'cds' ||
				strtolower($_GET['c']) == 'mp3' ||
				strtolower($_GET['c']) == 'original' ||
				strtolower($_GET['c']) == 'search' ||
				strtolower($_GET['c']) == 'config' ||
				strtolower($_GET['c']) == 'usuarios'){

				$controller = 'AccessController';

				if (isset($_GET['a']) && $_GET['a'] != 'main' && $_GET['a'] != 'login'){
					$_GET['a'] = 'main';
				}
			}
		}

		// Si existe el controlador
		if(is_file("Controller/".$controller.".php")){
	    	// Instancia el controlador
		    require_once "Controller/".$controller.".php";
		    $ctrl = new $controller;

		    // Llama la accion
		    self::setAction($ctrl);

	    }else{
			require_once '../frontend/View/404.php';
			exit();
	  	}
	}

	public static function setAction($ctrl){
		$action = isset($_GET['a']) ? $_GET['a'] : 'main';

		switch ($action) {
			case 'main':
				$ctrl->main();
				break;

			case 'nuevo':
				$ctrl->nuevo();
				break;

			case 'actualizar':
				$ctrl->actualizar();
				break;

			case 'editar':
				$ctrl->editar();
				break;

			case 'guardar':
				$ctrl->guardar();
				break;

			case 'borrar':
				$ctrl->borrar();
				break;

			case 'login':
				$ctrl->login();
				break;

			case 'logout':
				$ctrl->logout();
				break;

			case 'search':
				$ctrl->search();
				break;

			default:
				require_once '../frontend/View/404.php';
				break;
		}
	}

}
