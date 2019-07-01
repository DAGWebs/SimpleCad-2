<?php  
	session_start();
	ob_start();
	define("ROOT", '/' . strtolower(basename(getcwd())) . '/');


	if(file_exists("../config/config.php")) {
		require_once "../config/config.php";
	}

	spl_autoload_register(function($className) {
		if(file_exists("../classes/{$className}.php")) {
			require_once "../classes/{$className}.php";
		} else {
			throw new Exception("The class name {$className} does not exist.");
		}
	});

	if(!file_exists("../config/config.php")) {
		if($_SERVER["REQUEST_URI"] !== ROOT . "setup.php") {
			Helper::Redirect("../setup");
		}
	} else {

		$sql = DB::getInstance()->select('settings');

		while($row = DB::getInstance()->assoc($sql)) {
			define(strtoupper($row['setting_name']), $row['setting_value']);
		}

		if(Helper::isLoggedin()) {
		$username = $_SESSION['user_is_loggedin'];

		$query = DB::getInstance()->select('users','user_username', $username);

		if(DB::getInstance()->rows($query) == 1) {
			$row = DB::getInstance()->assoc($query);

			$username = $row['user_username'];
			$email = $row['user_email'];
			$code = $row['user_code'];
			$joined = $row['user_joined'];
			$discord = $row['user_discord'];
			$membership = $row['user_membership'];
			$rank = $row['user_rank'];
		}
	}
	}

	$current_root = $_SERVER['PHP_SELF'];
	switch ($current_root) {
		case ROOT . 'index.php':
			$page = 'Home';
			break;
		case ROOT . 'login.php':
			$page = "Login";
			break;
		case ROOT . 'register.php':
			$page = "Register";
			break;
		default:
			$page = 'Cad System';
			break;
	}

	require_once "inc/header.php";

	
?>