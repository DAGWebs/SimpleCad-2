<?php 
	class Setup {
		public static function runSetup() {
			if(isset($_POST['run_setup'])) {
				$errors = [];

				$db_host = Helper::clean($_POST['db_host']);
				$db_user = Helper::clean($_POST['db_user']);
				$db_pass = Helper::clean($_POST['db_pass']);
				$db_name = Helper::clean($_POST['db_name']);
				$verify = Helper::clean($_POST['cad_varification']);
				$cad_about = Helper::clean($_POST['cad_about']);
				$cad_name = Helper::clean($_POST['cad_name']);
				$admin_username = Helper::clean($_POST['admin_username']);
				$admin_email = Helper::clean($_POST['admin_email']);
				$admin_password = Helper::clean($_POST['admin_password']);
				$admin_cpassword = Helper::clean($_POST['admin_cpassword']);

				if(empty($db_host)) {
					$errors[] = "You must provide a database host.";
				}
				if(empty($db_user)) {
					$errors[] = "You must provide a database username.";
				}
				if(empty($db_pass)) {
					$errors[] = "You must provide a database password. (note if not using password put NO PASSWORD in the field)";
				}
				if(empty($db_name)) {
					$errors[] = "You must provide a database name.";
				}

				if(empty($cad_about)) {
					$errors[] = "You must provide statment about your community.";
				}
				if(empty($cad_name)) {
					$errors[] = "You must provide a community name.";
				}
				if($verify == 'noSelct') {
					$errors[] = "You must select if you want verification on or off.";
				}

				if(empty($admin_username)) {
					$errors[] = "You must provide an admin username.";
				}
				if(empty($admin_email)) {
					$errors[] = "You must provide an admin email.";
				}
				if(empty($admin_password)) {
					$errors[] = "You must provide an admin password.";
				}
				if(empty($admin_cpassword)) {
					$errors[] = "You must provide an admin email.";
				}

				if(strlen($admin_username) < 6) {
					$errors[] = "Admin username must be at least 6 characters long.";
				}

				if(strlen($admin_password) < 6) {
					$errors[] = "Admin Password must be longer than 6 characters.";
				} 

				if(!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
					$errors[] = "You must use a valid email";
				}

				if($admin_password != $admin_cpassword) {
					$errors[] = "Your password must match";
				}

				if($db_pass === "NO PASSWORD") {
					$db_pass = '';
				}

				$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

				if(!$con) {
					$errors[] = "Your database connection is incorrect.";
				}

				if(!empty($errors)) {
					echo '<div class="alert alert-danger" role="alert">';
					foreach($errors as $error) {
						echo $error . "<br>";
					}

					echo '</div>';
						  
						
				} else {

					if(!is_dir('config')) {
						mkdir('config');
					}

					$CreateConfig = fopen('config/config.php', 'w');

					if($db_pass === "NO PASSWORD") {
						$db_pass = '';
					}
					$config = "<?php\n";
					$config .= "//Created DATABASE CONFIG\n";
					$config .= "define('DB_HOST', '{$db_host}');\n";
					$config .= "define('DB_USER', '{$db_user}');\n";
					$config .= "define('DB_PASS', '{$db_pass}');\n";
					$config .= "define('DB_NAME', '{$db_name}');\n";

					fwrite($CreateConfig, $config);
					fclose($CreateConfig);

					$sql = "INSERT INTO settings (setting_name, setting_value) VALUES ('site_name', '{$cad_name}')";
					mysqli_query($con, $sql);

					$sql = "INSERT INTO settings (setting_name, setting_value) VALUES ('site_desc', '{$cad_about}')";
					mysqli_query($con, $sql);

					$sql = "INSERT INTO settings (setting_name, setting_value) VALUES ('site_verification', '{$verify}')";
					mysqli_query($con, $sql);

					$code = md5(uniqid() . $admin_username . $admin_email);
					$admin_password = password_hash($admin_password, PASSWORD_DEFAULT);

					$sql = "INSERT INTO users (user_username, user_email, user_password, user_code, user_valid, user_discord, user_membership) VALUES ('$admin_username', '$admin_email', '$admin_password','$code', 1, 'None Provided', 'Admin')";
					mysqli_query($con, $sql);

						$body = '<!DOCTYPE html>
									<html lang="en">
									<head>
										<meta charset="UTF-8">
										<title>Welcome Email</title>
									</head>
									<body style="background: #000; margin: 0; padding: 0;">
										<div style="text-align: center; background-color: #fff; padding: 10px; border-bottom: 2px solid darkgray;"><h1>Thanks for using SimpleCad!</h1></div>
										<div style="width: 90%; background: #fff; margin: 20px auto;">
											<div style="background: #222; padding: 10px;">
												<h3 style="text-align: center; color: #fff;">Admin Details</h3>
											</div>
											<div style="padding: 10px;">
												<p>Username: ' . $admin_username . '</p>
												<p>Email: ' . $admin_email . '</p>
												<p>Password: <span style="color: darkred">Due to security we dont provide this through email!</span></p>
												<p>Because you have registered as an administrator your account was auto approved. If you have any questions feel free to look up our documentation.</p>
											</div>
										</div>
										<div style="width: 90%; background: #fff; margin: 20px auto;">
											<div style="background: #222; padding: 10px;">
												<h3 style="text-align: center; color: #fff;">Setting Details</h3>
											</div>
											<div style="padding: 10px;">
												<p>Database Host: ' . $db_host . '</p>
												<p>Database Username: ' . $db_user . '</p>
												<p>Database Host: ' . $db_host . '</p>
												<p>Database Password: <span style="color: darkred">Due to security we dont provide this through email!</span></p>
												<p>Community Name: ' . $cad_name . '</p>
												<p>' . $cad_about . '</p>
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

									$subject = "Welcome to SimpleCad";

									$to = $admin_email;

									
					

					if(Helper::sendMail($to, $subject, $body)) {
						Helper::Redirect("index");
					}
				}
			} 
		} 
	}