<?php  
	class DB {
		private $_host;
		private $_user;
		private $_pass;
		private $_name;
		protected static $_instance;

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
			if(isset(self::$_instance)) {
				return self::$_instance;
			} else {
				return self::$_instance = new DB();
			}
		}

		public function query($sql) {
			$query = mysqli_query($this->connect(), $sql);

			return $query;
		}

		public function insert($keys, $values, $table) {
			if(!is_array($keys)) {
				die("Keys needs to be an array");
			} else {
				$keyString = '';
				foreach($keys as $key) {
					$keyString .= $key . ", ";
				}
				$keyString = rtrim($keyString, ", ");
			}

			if(!is_array($values)) {
				die("Values must be an array");
			} else {
				$valueString = "";
				foreach($values as $value) {
					$valueString .= "'" . $value . "', ";
				}
				$valueString = rtrim($valueString, ", ");
			}
			$sql = "INSERT INTO {$table} ({$keyString}) VALUES ({$valueString})";
			return $this->query($sql);
		}

		public function select($table, $ident='', $id='', $values=[], $selector='') {
			if(empty($ident) && empty($id) && empty($values)) {
				$sql = "SELECT * FROM {$table}";
				return $this->query($sql);
			} else if(!empty($values)) {
				$vals = '';
				foreach($values as $value) {
					$vals .= $value . ', ';
				}
				$vals = rtrim($vals, ', ');
				$sql = "SELECT {$vals} FROM {$table} WHERE {$ident} = '{$id}'";
				return $this->query($sql);
			} else if($selector === "AND" || $selector === "OR" || $selector === "NOT") {
				if(!is_array($ident)) {
					die("Please use an array form the identifier and id.");
				} else {
					$idL = "";
					foreach($ident as $ide => $value) {
						$idL .= $ide . " = '" . $value . "' " . $selector . " ";
					}
					$idL = rtrim($idL, " " . $selector);

					$sql = "SELECT * FROM {$table} WHERE {$idL}";
					return $this->query($sql);
				}
			} else if(!empty($ident) && !empty($id)) {
				$sql = "SELECT * FROM {$table} WHERE {$ident} = '{$id}'";
				return $this->query($sql);
			}
		}

		public function rows($query) {
			return mysqli_num_rows($query);
		}

		public function update($table, $option, $thing, $identifier, $id) {
			$sql = "UPDATE {$table} SET {$option} = '{$thing}' WHERE {$identifier} = '{$id}'";
			return $this->query($sql);
		}

		public function delete($table, $identifier, $id) {
			$sql = "DELETE FROM {$table} WHERE {$identifier} = '{$id}'";
			return $this->query($sql);
		}

		public function assoc($sql) {
			return mysqli_fetch_assoc($sql);
		}

		public function escape($string) {
			return mysqli_real_escape_string($this->connect(), $string);
		}
	}
?>