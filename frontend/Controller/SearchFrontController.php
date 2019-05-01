<?php
include_once 'frontend/Model/Search.php';

class SearchFrontController {
	private $buscador;
	private $search_term;
	private $page;
	private $num_pages;
	private $ctrl = 'search';  //controlador

    public function __construct(){
        $this->buscador = new Search();
    }

    public function index(){
    	$this->search();
    }

    public function getSearchTerm(){
    	return $this->search_term;
    }

	public function search(){
		$results = null;

		if (isset($_POST['search'])) {
			$this->search_term = $_POST['search'];
			// cookie de 15 minutos para mantener el termino de busqueda durante la paginación
			setcookie("front_search",$_POST['search'],time()+900);

		} else if(isset($_COOKIE['front_search'])){
			$this->search_term = $_COOKIE['front_search'];
		}

		if($this->search_term != ''){
			// Si exite una página la cargamos
	        if (isset($_GET['p'])) {
	            $this->page = $_GET['p'];
	        }else {
	            $this->page = 1;
	        }

			$results = $this->buscador->searchText($this->search_term, $this->page, REG_PAGE);


			if ($results && !is_array($results)) {
	            $results = array($results);
	        }
	    }

		include 'frontend/View/search_result.php';
	}

	public function getPager(){
        $this->num_pages = $this->buscador->getNumPages();

        include 'frontend/View/inc/pager.php';
    }

    public function getPage(){
        return $this->page;
    }

}
