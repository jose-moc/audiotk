<?php
require_once 'frontend/Model/Catalogo.php';
require_once 'frontend/Model/CdsMp3.php';

class OriginalFrontController {
	private $original;
	private $respuesta;
    private $page;
    private $num_pages;
    private $ctrl = 'original';  //controlador

	public function __construct(){
		$this->original = new Catalogo();
	}

	public function index(){
    	include 'frontend/View/original.php';
	}

    public function getAllOri(){
        $sort_by = "artista";   // columna ordenada por defecto
        $ordir = "ASC";         // dirección de ordenación (ASC/DESC) por defecto

        // Si exite una página la cargamos
        if (isset($_GET['p'])) {
            $this->page = $_GET['p'];
        } else {
            $this->page = 1;
        }

        if (isset($_COOKIE['front_sortori'])) {
            $sort_by = $_COOKIE['front_sortori'];
        }else {
            setcookie("front_sortori",$sort_by,time()+10800,'/');    // cookie de 3 horas con la columna que se esta ordenando
        }

        if(!isset($_COOKIE['front_oridir'])){
            setcookie("front_oridir","ASC",time()+10800,'/');   // cookie de 3 horas con la dirección de ordenación (ASC/DESC)
        } else {
            $ordir = $_COOKIE['front_oridir'];
        }

        // parámetros de la función: controlador, campo por el que se ordenan los registros, página actual, número de registros por página
        $this->respuesta = $this->original->getItemsPages($this->ctrl,$sort_by,$ordir,$this->page,REG_PAGE);

        if ($this->respuesta && !is_array($this->respuesta)) {
            $this->respuesta = array($this->respuesta);
        }

        return $this->respuesta;
    }

    public function getPager(){
        $this->num_pages = $this->original->getNumPages();

        include 'frontend/View/inc/pager.php';
    }

    public function getPage(){
        return $this->page;
    }

}
