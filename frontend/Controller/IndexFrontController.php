<?php
require_once 'frontend/Model/CdsMp3.php';
require_once 'frontend/Model/Catalogo.php';

class IndexFrontController {
    public function index(){
        include 'frontend/View/inicio.php';
    }

    public function lastItems($limit){
        $_cat = new Catalogo();

        $_items = $_cat->getLastItems($limit);
        return $_items;
    }

    public function getCds($id=null){
        $cds = new CdsMp3();

        // Si existe una id, traemos solo ese cd. Si no traemos todos los cds
        if (isset($id)) {
            $result = $cds->getById($id);
        } else {
            $result = $cds->getAll();
        }

        return $result;
    }
}
