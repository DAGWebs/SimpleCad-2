<?php  
	class DB {
		private $_host;
		private $_user;
		private $_pass;
		private $_name;
		protected $_instance;

		public function connect() {
			$this->_host = DB_HOST;
			$this->_user = DB_USER;
			$this->_pass = DB_PASS;
			$this->_name = DB_NAME;

			$con = mysqli_connect($this->_host, $this->_user, $this->_pass, $this->_name);

			if(!$con) {
				die("DATABASE ERROR: ");
			} else {
				return $con;
			}
		}

		public static function getInstance() {
			if(isset($this->_instance)) {
				return $this->_instance;
			} else {
				$this->_instance = new DB();
				return $this->_instance;
			}
		}

		public function query($sql) {
			$query = mysqli_query($this->connect(), $sql);

			if(mysqli_num_rows($query) < 1) {
				return false;
			} else {
				return $query;
			}
		}

		public function insert($keys, $values, $table) {
			if(!is_array()) {
				die("Keys needs to be an array");
			} else {
				$keyString = '';
				foreach($keys as $key) {
					$keyString .= $key . ", ";
				}
				rtrim($keyString, ", ");
			}

			if(!is_array($values)) {
				die("Values must be an array");
			} else {
				$valueString = "";
				foreach($values as $value) {
					$valueString .= "'" . $value . "', ";
				}
				rtrim($valueString, ", ");
			}
			$sql = "INSERT INTO {$table} ({$keyString}) VALUES ({$valueString})";
		}
	}
?>