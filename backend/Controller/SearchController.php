<?php
include_once 'Model/Search.php';

class SearchController {
	private $buscador;
	private $search_term;
	private $page;
	private $num_pages;
	private $ctrl = 'search';  //controlador

    public function __construct(){
        $this->buscador = new Search();
    }

    public function main(){
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
			setcookie("search",$_POST['search'],time()+900);

		} else if(isset($_COOKIE['search'])){
			$this->search_term = $_COOKIE['search'];
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

		include 'View/search/search_result.php';
	}

	public function getPager(){
        $this->num_pages = $this->buscador->getNumPages();

        include 'View/inc/pager.php';
    }

    public function getPage(){
        return $this->page;
    }

}
