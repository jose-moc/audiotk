<?php
/*
* Las funciones ob_start (Activa el almacenamiento en búfer de la salida) y ob_end_flush (Vacía búfer de salida y deshabilita el almacenamiento en el mismo), se usan para que funcionen correctamente las funciones header('Location: ') de php
*/
class Session {

	public static function start(){
		ini_set("session.cookie_lifetime","10800");	// tiempo de vida de una sesión en segundos (10800s = 3h)
		ini_set("session.gc_maxlifetime","10800");	// evitar que el recolector de basura de php elimine la cookie antes de su expiración.
		ob_start();
		session_start();
	}

	public static function get($s_name){
		if (isset($_SESSION[$s_name])) {
			return $_SESSION[$s_name];
		}

		return false;
	}

	public static function set($name, $value){
		$_SESSION[$name] = $value;
	}

	public static function destroy(){
		session_destroy();

		// Elimina las cookies haciendo que se caduquen
		foreach (@$_COOKIE as $key => $valor){
			setcookie($key,$value,time()-600,'/');
		}
		header('Location: '.ADMIN_URL.'access');
		ob_end_flush();
	}

}
