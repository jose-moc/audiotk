<?php  
	function autoload($class){
		include "inc/" . $class . ".php";
	}

	spl_autoload_register('autoload');
?>