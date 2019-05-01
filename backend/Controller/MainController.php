<?php
require_once 'Model/CdsMp3.php';
require_once 'Model/Catalogo.php';

class MainController {
    public function main(){
        include 'View/inicio.php';
    }

    public static function countItems($data){
    	switch ($data) {
    		case 'cd':
    			$_cds = new CdsMp3();
    			$count = $_cds->getNumRows();
    			break;

    		case 'mp3':
    			$_mp3 = new Catalogo();
                $count = $_mp3->getNumRows('mp3',1);
    			break;

    		case 'ori':
    			$_ori = new Catalogo();
                $count = $_ori->getNumRows('original',0);
    			break;

    		default:
    			$count = 0;
    			break;
    	}

    	return $count;
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
