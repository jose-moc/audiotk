<?php
class ViewFrontController {

	public static function frontTemplate(){
		include "frontend/View/front.php";
	}

	public static function loadView(){
		$c = (isset($_GET['c']))? strtolower($_GET['c']) : 'index';
		$controller = ucwords(strtolower($c)). 'FrontController';

		// Si existe el controlador
		if(is_file("frontend/Controller/".$controller.".php")){
	    	// Instancia el controlador
		    require_once "frontend/Controller/".$controller.".php";
		    $ctrl = new $controller;

		    // Llama la accion
		    self::setAction($ctrl);

	    }else{
			require_once 'frontend/View/404.php';
	  	}
	}

	public static function setAction($ctrl){
		$action = isset($_GET['a']) ? $_GET['a'] : 'index';

		switch ($action) {
			case 'index':
				$ctrl->index();
				break;

			case 'listar':
				$ctrl->listar();
				break;

			case 'search':
				$ctrl->search();
				break;

			default:
				require_once 'frontend/View/404.php';
				break;
		}
	}

}
