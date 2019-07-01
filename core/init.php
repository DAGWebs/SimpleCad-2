<?php  
	spl_autoload_register(function($className) {
		if(file_exists("classes/{$className}.php")) {
			require_once "classes/{$className}.php";
		} else {
			throw new Exception("The class name {$className} does not exist.");
		}
	});

	$current_root = $_SERVER['PHP_SELF'];
	$current_root = rtrim($current_root, 'setup.php');

	define("ROOT", $current_root);

	if(!file_exists("config/config.php")) {
		if($_SERVER["REQUEST_URI"] !== ROOT . "setup.php") {
			Helper::Redirect("setup");
		}
	}

	if($_SERVER['REQUEST_URI'] === ROOT . "dashboard.php") {
		require_once "inc/dashboard_header.php";
	} else if($_SERVER['REQUEST_URI'] === ROOT . "admin.php") {
		require_once "inc/dashboard_header.php";
	} else {
		require_once "inc/header.php";
	}
?>