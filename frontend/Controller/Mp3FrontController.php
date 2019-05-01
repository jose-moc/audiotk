<?php
require_once 'frontend/Model/Catalogo.php';
require_once 'frontend/Model/CdsMp3.php';

class Mp3FrontController {
	private $mp3;
	private $respuesta;
	private $page;
	private $num_pages;
	private $ctrl = 'mp3';	//controlador

	public function __construct(){
		$this->mp3 = new Catalogo();
	}

	public function index(){
		$this->mp3 = new Catalogo();
    	include 'frontend/View/mp3.php';
	}

	public function getAllMp3(){
		$sort_by = "artista";	// columna ordenada por defecto
		$ordir = "ASC";			// dirección de ordenación (ASC/DESC) por defecto

		// Si exite una página la cargamos
        if (isset($_GET['p'])) {
            $this->page = $_GET['p'];
        }else {
            $this->page = 1;
        }

        if (isset($_COOKIE['front_sortmp3'])) {
            $sort_by = $_COOKIE['front_sortmp3'];
        } else {
        	setcookie("front_sortmp3",$sort_by,time()+10800,'/');	// cookie de 3 horas con la columna que se esta ordenando
        }

        if(!isset($_COOKIE['front_mp3dir'])){
            setcookie("front_mp3dir","ASC",time()+10800,'/');   // cookie de 3 horas con la dirección de ordenación (ASC/DESC)
        } else {
            $ordir = $_COOKIE['front_mp3dir'];
        }

		// parámetros de la función: controlador, campo por el que se ordenan los registros, página actual, número de registros por página
		$this->respuesta = $this->mp3->getItemsPages($this->ctrl,$sort_by,$ordir,$this->page,REG_PAGE);

		if ($this->respuesta && !is_array($this->respuesta)) {
            $this->respuesta = array($this->respuesta);
        }

		return $this->respuesta;
	}

	public function getPage(){
		return $this->page;
	}

	public function getPager(){
        $this->num_pages = $this->mp3->getNumPages();

        include 'frontend/View/inc/pager.php';
    }

	public function getCds($id=null){
		$cds = new CdsMp3();

		// Si existe una id, traemos solo ese cd. Si no traemos todos los cds
		if (isset($id)) {
			$this->respuesta = $cds->getById($id);
		} else {
			$this->respuesta = $cds->getAll();
		}

		return $this->respuesta;
	}
}
