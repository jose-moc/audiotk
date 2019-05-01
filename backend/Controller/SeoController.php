<?php
class SeoController {
	private static $_title;

	public static function title(){
		$_title = 'Audiotk';

		if(isset($_GET['c'])){
			switch ($_GET['c']) {
				case 'access':
					self::$_title = 'Acceso Audiotk';
					break;

				case 'main':
					self::$_title = 'Inicio';
					break;

				case 'cds':
					self::$_title = 'Cds de Mp3';
					break;

				case 'mp3':
					self::$_title = 'Mp3';
					break;

				case 'original':
					self::$_title = 'Discos Originales';
					break;

				case 'search':
					self::$_title = 'Buscar en Audiotk';
					break;

				case 'config':
					self::$_title = 'Configuración';
					break;

				case 'usuarios':
					self::$_title = 'Usuarios';
					break;
			}

		}

		if(isset($_GET['a'])){

			switch ($_GET['a']) {
				case 'nuevo':
					self::$_title = 'Nuevos '.strtolower(self::$_title);
					break;

				case 'actualizar':
					self::$_title = 'Actualizar '.strtolower(self::$_title);
					break;

				case 'editar':
					self::$_title = 'Editar '.strtolower(self::$_title);
					break;

			}
		}

		return self::$_title;
	}


}
