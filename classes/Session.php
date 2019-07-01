<?php 

class Session {
	public static function set($name, $value) {
		return $_SESSION[$name] = $value;
	}

	public static function get($name) {
		return $_SESSION[$name];
	}

	public static function alert($name, $value, $type, $add='') {
		self::set($name, $type);
		if(!empty($add)) {
			$other = [$add];
		} 

		array_push($other, $type);

		return $other;
	}

	public static function viewFlash($name, $type, $message, $add='') {
		if(isset($_SESSION[$name])) {
			echo '<div class="alert alert-' . $type . '" role="alert">
				  <h4 class="alert-heading">' . $name . '</h4>
				  <p>' . $message . '</p>';
			if(!empty($add)) {
				echo '<hr>
	  				<p class="mb-0">' . $add . '</p>';
			}		 
			echo '</div>';

			unset($_SESSION[$name]);
		}
	}

	public static function delete($name) {
		unset($_SESSION[$name]);
	}
}