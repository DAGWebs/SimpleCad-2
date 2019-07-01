<?php 

	class Accounts {
		public function create() {
			if(isset($_POST['register_account'])) {
				$username = Helper::clean(DB::getInstance()->escape($_POST['username']));
				$email = Helper::clean(DB::getInstance()->escape($_POST['email']));
				$discord = Helper::clean(DB::getInstance()->escape($_POST['discord']));
				$password = Helper::clean(DB::getInstance()->escape($_POST['password']));
				$cpassword = Helper::clean(DB::getInstance()->escape($_POST['cpassword']));
				$signature = Helper::clean(DB::getInstance()->escape($_POST['signature']));

				$errors = [];

				if(!isset($_POST['sig_check'])) {
					$errors[] = "You must agree to our terms of service before you may register for ". SITE_NAME . '.';
				} else {
					if(empty($signature)) {
						$errors[] = "You must sign the TOS agreement for ". SITE_NAME . '.';
					} else {
						if(empty($username) || empty($email) || empty($discord) || empty($password) || empty($cpassword)) {
							$errors[] = "All fields are required!";
						}

						$query = DB::getInstance()->select('users', 'user_username', $username);

						if(mysqli_num_rows($query) > 0) {
							$errors[] = "That username already exists in our system";
						}

						$query = DB::getInstance()->select('users', 'user_email', $email);

						if(mysqli_num_rows($query) > 0) {
							$errors[] = "That email already exists in our system";
						}

						if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$errors[] = "You must provide a vailid email";
						}

						if(strlen($username) < 6) {
							$errors[] = "Your username can not be shorter than 6 characters";
						}

						if(strlen($password) < 6) {
							$errors[] = "Your password can not be shorter than 6 characters";
						}

						if($password !== $cpassword) {
							$errors[] = "Your passwords must match";
						}
					}
				}

				if(!empty($errors)) {
					echo '<div class="alert alert-danger text-center" role="alert">';
					foreach($errors as $error) {
						echo $error . "<br>";
					}

					echo '</div>';
						  
						
				} else {
					$code = md5(uniqid() . $username . $email);
					$password = password_hash($password, PASSWORD_DEFAULT);

					if(SITE_VERIFICATION === "YES") {
						$verify = 0;
					} else {
						$verify = 1;
					}

					$values = [
						'user_username',
						'user_email',
						'user_password',
						'user_code',
						'user_valid',
						'user_discord'
					];

					$items = [
						$username,
						$email,
						$password,
						$code,
						$verify,
						$discord
					];

					DB::getInstance()->insert($values, $items, 'users');

					$subject = "Welcome to " . SITE_NAME . "'s Cad System";
					if(SITE_VERIFICATION === "YES") {
						$body = '<!DOCTYPE html>
									<html lang="en">
									<head>
										<meta charset="UTF-8">
										<title>Welcome Email</title>
									</head>
									<body style="background: #000; margin: 0; padding: 0;">
										<div style="text-align: center; background-color: #fff; padding: 10px; border-bottom: 2px solid darkgray;"><h1>Thanks for Registering!</h1></div>
										<div style="width: 90%; background: #fff; margin: 20px auto;">
											<div style="background: #222; padding: 10px;">
												<h3 style="text-align: center; color: #fff;">Account Details</h3>
											</div>
											<div style="padding: 10px;">
												<p>Username: ' . $username . '</p>
												<p>Email: ' . $email . '</p>
												<p>Discord: ' . $discord . '</p>
												<p>Password: <span style="color: darkred">Due to security we dont provide this through email!</span></p>
												<p>Because your SimpleCad Administrator has set verification on you must verify your email before you can login. Just click on the button below in order to compleate your registration.</p>
												<a href="' . SITE_URL . 'login.php?user_verify_account=' . $code . '" style="background: #222; min-width: 100%; border: none; text-decoration: none; padding: 5px; color: #fff; box-shadow: 4px 4px 4px black;">Compleate Registration!</a>
											</div>
										</div>
										<div style="width: 90%; background: #fff; margin: 20px auto;">
											<div style="background: #222; padding: 10px;">
												<h3 style="text-align: center; color: #fff;">About SimpleCad</h3>
											</div>
											<div style="padding: 10px;">
												<p>Developed By: dTech Development</p>
												<p>Email: support@daghq.com</p>
												<a href="#" style="background: #222; border: none; text-decoration: none; padding: 5px; color: #fff; box-shadow: 4px 4px 4px black;">Find out More!</a>
												<p>SimpleCad is a cad that has been developed by dTech Development, a sub division under the DarkArts Gaming Community. We develop technologies from discord bots to websites. we are always looking for more talented peopled to join us.</p>
											</div>
										</div>
									</body>
									</html>';
					} else {
						$body = '<!DOCTYPE html>
								<html lang="en">
								<head>
									<meta charset="UTF-8">
									<title>Welcome Email</title>
								</head>
								<body style="background: #000; margin: 0; padding: 0;">
									<div style="text-align: center; background-color: #fff; padding: 10px; border-bottom: 2px solid darkgray;"><h1>Thanks for Registering!</h1></div>
									<div style="width: 90%; background: #fff; margin: 20px auto;">
										<div style="background: #222; padding: 10px;">
											<h3 style="text-align: center; color: #fff;">Account Details</h3>
										</div>
										<div style="padding: 10px;">
											<p>Username: ' . $username . '</p>
											<p>Email: ' . $email . '</p>
											<p>Discord: ' . $discord . '</p>
											<p>Password: <span style="color: darkred">Due to security we dont provide this through email!</span></p>
											<p>Because your SimpleCad Administrator has set verification on you must verify your email before you can login. Just click on the button below in order to compleate your registration.</p>
											<a href="' . SITE_URL . 'login.php?user_verify_account=' . $code . '" style="background: #222; min-width: 100%; border: none; text-decoration: none; padding: 5px; color: #fff; box-shadow: 4px 4px 4px black;">Compleate Registration!</a>
										</div>
									</div>
									<div style="width: 90%; background: #fff; margin: 20px auto;">
										<div style="background: #222; padding: 10px;">
											<h3 style="text-align: center; color: #fff;">About SimpleCad</h3>
										</div>
										<div style="padding: 10px;">
											<p>Developed By: dTech Development</p>
											<p>Email: support@daghq.com</p>
											<a href="#" style="background: #222; border: none; text-decoration: none; padding: 5px; color: #fff; box-shadow: 4px 4px 4px black;">Find out More!</a>
											<p>SimpleCad is a cad that has been developed by dTech Development, a sub division under the DarkArts Gaming Community. We develop technologies from discord bots to websites. we are always looking for more talented peopled to join us.</p>
										</div>
									</div>
								</body>
								</html>';
					}

					Helper::sendMail($email, $subject, $body);
					Helper::Redirect('login', "?user_registerd=true");
				}
			}
		}

		public function login() {
			if(isset($_POST['user_login'])) {
				$username = Helper::clean(DB::getInstance()->escape($_POST['username']));
				$password = Helper::clean(DB::getInstance()->escape($_POST['password']));

				$errors = [];

				if(empty($username) || empty($password)) {
					$errors[] = "Both fields are required";
				} else {
					$sql = DB::getInstance()->select('users', ['user_username' => $username, 'user_email' => $username], '', [], 'OR');
					if(mysqli_num_rows($sql) != 1) {
						$errors[] = "Your login creditials are incorrect!";
					} else {
						$row = DB::getInstance()->assoc($sql);
						$username = $row['user_username'];
						$valid = $row['user_valid'];
						$email = $row['user_email'];
						$db_pass = $row['user_password'];

						if(!password_verify($password, $db_pass)) {
							$errors[] = "Your login creditials are incorrect!";
						}

						if($valid == 0) {
							$errors[] = "Your account has not been verified yet!";
						}
					}
				}

				if(!empty($errors)) {
					echo '<div class="alert alert-danger text-center" role="alert">';
					foreach($errors as $error) {
						echo $error . "<br>";
					}

					echo '</div>';
						  
						
				} else {
					Session::set('user_is_loggedin', $username);
					Helper::Redirect('index',"?user_logged_in");
				}
			}
		}

		public function reset() {
			if(isset($_POST['reset_password'])) {
				$username = Helper::clean(DB::getInstance()->escape($_POST['username']));
				$email = Helper::clean(DB::getInstance()->escape($_POST['email']));

				$errors = [];

				if(empty($username) || empty($email)) {
					$errors[] = 'All fields are required';
				}

				if(!empty($errors)) {
					echo '<div class="alert alert-danger text-center" role="alert">';
					foreach($errors as $error) {
						echo $error . "<br>";
					}

					echo '</div>';
						  
						
				} else {
					$query = DB::getInstance()->select('users', ['user_username' => $username, 'user_email' => $email], '', [], 'AND');

					if(DB::getInstance()->rows($query) == 1) {
						$row = DB::getInstance()->assoc($query);

						$code = $row['user_code'];

						$subject = "Change Password";

						$body = '<!DOCTYPE html>
									<html lang="en">
									<head>
										<meta charset="UTF-8">
										<title>Welcome Email</title>
									</head>
									<body style="background: #000; margin: 0; padding: 0;">
										<div style="text-align: center; background-color: #fff; padding: 10px; border-bottom: 2px solid darkgray;"><h1>Forgot your password?</h1></div>
										<div style="width: 90%; background: #fff; margin: 20px auto;">
											<div style="background: #222; padding: 10px;">
												<h3 style="text-align: center; color: #fff;">Reset Password</h3>
											</div>
											<div style="padding: 10px;">
												
												<p>You are reciving this email because you have requested a password reset for you account. If you belive this to be an error you should login to your account and change you password ASAP. The button below will take you to change your password!</p>
												<a href="' . SITE_URL . 'reset.php?reset_user=true&reset_code=' . $code . '" style="background: #222; min-width: 100%; border: none; text-decoration: none; padding: 5px; color: #fff; box-shadow: 4px 4px 4px black;">Login!</a>
											</div>
										</div>
										<div style="width: 90%; background: #fff; margin: 20px auto;">
											<div style="background: #222; padding: 10px;">
												<h3 style="text-align: center; color: #fff;">About SimpleCad</h3>
											</div>
											<div style="padding: 10px;">
												<p>Developed By: dTech Development</p>
												<p>Email: support@daghq.com</p>
												<a href="#" style="background: #222; border: none; text-decoration: none; padding: 5px; color: #fff; box-shadow: 4px 4px 4px black;">Find out More!</a>
												<p>SimpleCad is a cad that has been developed by dTech Development, a sub division under the DarkArts Gaming Community. We develop technologies from discord bots to websites. we are always looking for more talented peopled to join us.</p>
											</div>
										</div>
									</body>
									</html>';

									Helper::sendMail($email, $subject, $body);
					}

						echo  '<div class="alert alert-success text-center" role="alert"> If the email: ' . $email . ' and the Username: ' . $username . ' exists you will have been sent instructions to reset your password.</div>';
				}
			}
		}

		public function changePassword() {
			if(isset($_POST['change_password'])) {
				$password = Helper::clean(DB::getInstance()->escape($_POST['password']));
				$cpassword = Helper::clean(DB::getInstance()->escape($_POST['cpassword']));
				$code = $_POST['code'];

				$errors = [];

				if(empty($password) || empty($cpassword)) {
					$errors[] = 'All fields are required';
				}

				if($password != $cpassword) {
					$errors[] = "Passwords must match";
				}

				if(strlen($password) < 6) {
					$errors[] = "Password must be atleast 6 characters";
				}

				if(!empty($errors)) {
					echo '<div class="alert alert-danger text-center" role="alert">';
					foreach($errors as $error) {
						echo $error . "<br>";
					}

					echo '</div>';
						  
						
				} else {
					$query = DB::getInstance()->select('users', 'user_code', $code);

					if(DB::getInstance()->rows($query) == 1) {
						$row = DB::getInstance()->assoc($query);

						$id = $row['user_id'];

						$password = password_hash($password, PASSWORD_DEFAULT);

						$sql = DB::getInstance()->update('users', 'user_password', $password, 'user_id', $id);

						Helper::Redirect('login');
					}
				}
			}
		}
	}