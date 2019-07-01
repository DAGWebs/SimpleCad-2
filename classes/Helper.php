<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	class Helper {
		public static function Redirect($location, $variables='') {
			if(file_exists($location . ".php")) {
				return header("Location: {$location}.php{$variables}");
			} else {
				return header("Location: error404.php");
			}
		}

		public static function reload($time = 0) {
			return header("Refresh: {$time}");
		}

		public static function getPageTitle() {
			if(file_exists("config/config.php")) {
				$title = $_SERVER['REQUEST_URI'];
				$title = ltrim($title, ROOT);
				$title = rtrim($title, '.php');
				$title = ucfirst($title);
				global $page;
				echo SITE_NAME . " | " . $page;
			} else {
				echo "SimpleCad Setup";
			}
		}

		public static function getPageName() {
			if(file_exists("config/config.php")) {
				echo SITE_NAME;
			} else {
				echo "SimpleCad Setup";
			}
		}

		public static function clean($string) {
			return htmlentities($string, ENT_QUOTES, 'UTF-8');
		}

		public static function isLoggedin() {
			if(isset($_COOKIE['user_is_loggedin']) || isset($_SESSION['user_is_loggedin'])) {
				return true;
			} else {
				return false;
			}
		}

		/*=======================================
		=            Email Functions            =
		=======================================*/
		
		public static function sendMail($to, $subject, $body, $protocal='ssl', $reply=['support@daghq.com' => 'SimpleCad Support'], $debug=0, $from=['support@daghq.com' => 'SimpleCad'], $host='mail.daghq.com', $user='support@daghq.com', $password='Cartarman1', $port='465') {
			// Load Composer's autoloader
			require 'vendor/autoload.php';

			// Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
			    //Server settings
			    $mail->SMTPDebug = $debug;                                       // Enable verbose debug output
			    $mail->isSMTP();                                            // Set mailer to use SMTP
			    $mail->Host       = $host;  // Specify main and backup SMTP servers
			    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			    $mail->Username   = $user;                     // SMTP username
			    $mail->Password   = $password;                               // SMTP password
			    $mail->SMTPSecure = $protocal;                                  // Enable TLS encryption, `ssl` also accepted
			    $mail->Port       = $port;                                    // TCP port to connect to

			    //Recipients
			    foreach($from as $address => $val) {
			    	$mail->setFrom($address, $val);
			    }

			    if(is_array($to)) {
			    	foreach($to as $address) {
			   			$mail->addAddress($address);     // Add a recipient
			    	}
			    } else {
			    	$mail->addAddress($to);     // Add a recipient
			    }
			    
			   if(is_array($reply)) {
			   		foreach($reply as $address => $val) {
			   			$mail->addReplyTo($address, $val);
			   		}
			   }

			   

			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = $subject;
			    $mail->Body    = $body;

			    $mail->send();
			} catch (Exception $e) {
			    return false;
			}
		}
		
		/*=====  End of Email Functions  ======*/
		


		/*====================================
		=            Form Helpers            =
		====================================*/
		
		public static function getInput($type, $name, $classes=[], $placeholder='', $id='', $label='', $value='', $autocomplete='off', $bootstrap=true) {

			$classList = '';
			if(!empty($classes)) {
				foreach($classes as $class) {
					$classList .= $class . " ";
				}

				$classList = rtrim($classList, ' ');
			}

			if(!empty($label)) {
				$label = "<label for='{$id}'>{$label}</label>";
			} else {
				$label = '';
			}

			$input = "<input type='{$type}' name='{$name}' ";
			$input .= "class='{$classList}' placeholder='{$placeholder}' ";
			$input .= "id='{$id}' value='{$value}' autocomplete='{autocomplete}'>";

			if($bootstrap == true) {
				echo "<div class='form-group'>";
				echo $label;
				echo $input;
				echo "</div>";
			} else {
				echo $label;
				echo $input;
			}
		}

		public static function getTextArea($name, $classes=[], $placeholder='', $id='', $label='', $value='', $autocomplete='off', $bootstrap=true) {

			$classList = '';
			if(!empty($classes)) {
				foreach($classes as $class) {
					$classList .= $class . " ";
				}

				$classList = rtrim($classList, ' ');
			}

			if(!empty($label)) {
				$label = "<label for='{$id}'>{$label}</label>";
			} else {
				$label = '';
			}

			$input = "<textarea name='{$name}' ";
			$input .= "class='{$classList}' placeholder='{$placeholder}' ";
			$input .= "id='{$id}' autocomplete='{autocomplete}'>{$value}</textarea>";

			if($bootstrap == true) {
				echo "<div class='form-group'>";
				echo $label;
				echo $input;
				echo "</div>";
			} else {
				echo $label;
				echo $input;
			}
		}
		
		/*=====  End of Form Helpers  ======*/
		

	}