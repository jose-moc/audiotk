<?php
//require_once "../config.php";
class DataBase {

	public static function conexion(){
		$_mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
		$_mysqli->set_charset('utf8');

		return $_mysqli;
	}
}
