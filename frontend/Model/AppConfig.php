<?php
require_once "BaseModel.php";

class AppConfig extends BaseModel{
	private $table;
	private $url_base;
	private $last_reg;
	private $reg_per_page;
	private $genders;
	private $app_name;

	public function __construct(){
		$this->table = 'configuracion';
		parent::__construct($this->table);
	}

	public function getUrlBase(){
		$query = "SELECT * FROM {$this->table} WHERE variable LIKE 'url_base'";
		$this->url_base = $this->select($query);

		return $this->url_base;
	}

	public function getLastReg(){
		$query = "SELECT * FROM {$this->table} WHERE variable LIKE 'ultimos_reg'";
		$this->last_reg = $this->select($query);

		return $this->last_reg;
	}

	public function getRegPerPage(){
		$query = "SELECT * FROM {$this->table} WHERE variable LIKE 'reg_por_pagina'";
		$this->reg_per_page = $this->select($query);
		return $this->reg_per_page;
	}

	public function getGenders(){
		if (!isset($this->genders)) {
			$query = "SELECT * FROM {$this->table} WHERE variable LIKE 'generos'";
			$this->genders = $this->select($query);
		}

		return $this->genders;
	}


	public function getAppName(){
		$query = "SELECT * FROM {$this->table} WHERE variable LIKE 'app_name'";
		$this->app_name = $this->select($query);

		return $this->app_name;
	}

	public function setGenders($gen){
		$this->genders = $gen;
	}

	public function updateConf($ids){
		$arr_ids = implode(',', array_keys($ids));
		$query = "UPDATE {$this->table} SET valor = CASE id ";

		foreach ($ids as $key => $value) {
			$query .= "WHEN '{$key}' THEN '{$value}' ";
		}

		$query .= "END WHERE id IN ({$arr_ids})";

		$result = $this->update($query);

		return $result;
	}

}
