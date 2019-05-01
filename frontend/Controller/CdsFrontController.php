<?php
require_once 'frontend/Model/CdsMp3.php';
require_once 'frontend/Model/Catalogo.php';

class CdsFrontController{
	private $cds;
    private $mp3;
    private $respuesta;
    private $page;
    private $num_pages;
    private $ctrl = 'cds';  //controlador

    public function __construct(){
        $this->cds = new CdsMp3();
    }

    public function setMp3(){
        $this->mp3 = new Catalogo();
    }

    public function index(){
    	include 'frontend/View/cds.php';
    }

    public function listar(){
        if ($_GET['id'] !== null) {
            $this->mp3 = new Catalogo();
            $albums = $this->mp3->getChild($_GET['id']);
            $_cd = $this->getCd($_GET['id']);
        }

        include 'frontend/View/cd-items.php';
    }

    public function getCdByName($name){
        $this->respuesta = $this->cds->getBy('nombre',$name,'nombre');

        return $this->respuesta;
    }

    public function getAllCds(){
        $sort_by = 'nombre';

        // Si exite una página la cargamos
        if (isset($_GET['p'])) {
            $this->page = $_GET['p'];
        } else {
            $this->page = 1;
        }

        $reg_page = REG_PAGE;

        // parámetros de la función: campo por el que se ordenan los registros, página actual, número de registros por página
        $this->respuesta = $this->cds->getCdPages($sort_by,$this->page,$reg_page);

        if ($this->respuesta && !is_array($this->respuesta)) {
            $this->respuesta = array($this->respuesta);
        }

        return $this->respuesta;
    }

    public function getPager(){
        $this->num_pages = $this->cds->getNumPages();

        include 'frontend/View/inc/pager.php';
    }

    public function getPage(){
        return $this->page;
    }

    public function getAllMp3(){
        $this->respuesta = $this->mp3->getMp3Free();

        if ($this->respuesta && !is_array($this->respuesta)) {
            $this->respuesta = array($this->respuesta);
        }

        return $this->respuesta;
    }

    public function getCd($id){
        $this->respuesta = $this->cds->getById($id);
        return $this->respuesta;
    }
}

