<?php
require_once 'Model/CdsMp3.php';
require_once 'Model/Catalogo.php';

class CdsController{
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

    public function main(){
        if(isset($_GET['m'])){
            MessagesController::setMessage($_GET['m']);
        }

    	include 'View/cds/cds.php';
    }

    public function nuevo(){
        include 'View/cds/new_cd.php';
    }

    public function editar(){
        $item = new CdsMp3();

        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
            $item = $this->cds->getById($_GET['id']);
        }

        include 'View/cds/edit_cd.php';
    }

    public function guardar(){
        if(isset($_POST['nombre'])){
            $this->cds->setName(strip_tags($_POST['nombre']));

            if(isset($_POST['qty'])){
                $this->cds->setQty(strip_tags($_POST['qty']));
            }

            $this->respuesta = $this->cds->newCd();
        }

        if($this->respuesta){
            header('Location: '.ADMIN_URL.'index.php?c=cds&m=n1-'.base64_encode($_POST['nombre']));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=cds&m=n0-'.base64_encode($_POST['nombre']));
        }
    }

    public function actualizar(){
        if(isset($_POST['id']) && isset($_POST['nombre'])){
            $this->cds->setId($_POST['id']);
            $this->cds->setName(strip_tags($_POST['nombre']));

            if(isset($_POST['qty'])){
                $this->cds->setQty(strip_tags($_POST['qty']));
            }

            $this->respuesta = $this->cds->updateCd();

        }

        if($this->respuesta){
            if(isset($_POST['add2cd'])){
                $this->cds->addItemsToCd($_POST['add2cd']);
            }

            header('Location: '.ADMIN_URL.'index.php?c=cds&m=u1-'.base64_encode($_POST['nombre']));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=cds&m=u0-'.base64_encode($_POST['nombre']));
        }
    }

    public function borrar(){
        if(isset($_GET['id'])){
            $this->cds->setId($_GET['id']);
            $_cd = $this->cds->getById($_GET['id']);
            $this->respuesta = $this->cds->deleteCd();

            // borramos todas las referencias al cd
            $this->setMp3();
            $this->mp3->deleteCdId($_GET['id']);
        }

        if($this->respuesta){
            header('Location: '.ADMIN_URL.'index.php?c=cds&m=d1-'.base64_encode($_cd->nombre));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=cds&m=d0-'.base64_encode($_cd->nombre));
        }
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
            // guardamos la página en una variable de sesión por si necesitamos volver.
            Session::set('page_cds', $this->page);

        // sino miramos en la variable de sesión por si venimos de una página en concreto
        } else if (isset($_SESSION['page_cds'])) {
            $this->page = $_SESSION['page_cds'];

        }else {
            $this->page = 1;
        }

        $reg_page = ceil(REG_PAGE/2);

        // parámetros de la función: campo por el que se ordenan los registros, página actual, número de registros por página
        $this->respuesta = $this->cds->getCdPages($sort_by,$this->page,$reg_page);

        if ($this->respuesta && !is_array($this->respuesta)) {
            $this->respuesta = array($this->respuesta);
        }

        return $this->respuesta;
    }

    public function getPager(){
        $this->num_pages = $this->cds->getNumPages();

        include 'View/inc/pager.php';
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

