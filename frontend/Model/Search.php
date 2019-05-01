<?php
require_once "Base.php";

class Search extends Base {
	private $table = 'catalogo';
	private $number_of_pages;

	public function __construct(){
		parent::__construct($this->table);
	}

	public function searchText($text, $page, $reg_page){
		$init = ($page > 1) ? (($page * $reg_page) - $reg_page) : 0;

		$text = str_replace('\'', '&#39;', $text);
		$query = "SELECT SQL_CALC_FOUND_ROWS cd.id as cdid, cd.nombre, ca.id as mp3id, ca.artista, ca.album, ca.fecha, ca.genero, ca.img_front, ca.img_back, ca.mp3, ca.original
				  FROM cds_mp3 cd RIGHT JOIN catalogo ca
				  ON cd.id = ca.cdmp3_id
				  WHERE cd.nombre LIKE '%{$text}%' OR ca.artista LIKE '%{$text}%' OR ca.album LIKE '%{$text}%' OR ca.fecha LIKE '%{$text}%' LIMIT {$init},{$reg_page}";

		$result = $this->select($query);

		$rows = $this->select("SELECT FOUND_ROWS() as total");
		$total_reg = $rows->total;
		$this->number_of_pages = ceil($total_reg/$reg_page);

		return $result;
	}

	public function getNumPages(){
		return $this->number_of_pages;
	}

}
