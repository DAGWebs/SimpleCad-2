<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php Helper::getPageTitle(); ?></title>
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- fonts -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display|Poppins|Rubik+Mono+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Herr+Von+Muellerhoff&display=swap" rel="stylesheet">
	<!-- icons -->
	<script src="https://kit.fontawesome.com/85bf85c043.js"></script>
	<!-- my styles -->
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="min-height: 100vh;">
	
<header class="bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-6">
				<button class="btn btn-success btn-sm">
					<?php  
						if($_SERVER['REQUEST_URI'] === ROOT . 'setup.php') {
							echo "Welcome: Server Owner"; 
						} else if(!Helper::isLoggedin()) {
							echo "Welcome: Guest";
						} else {
							echo "Welcome Back: " . $username;
						}
					?>
				</button>
			</div>
			<div class="col-6">
				<ul class="default">
					<li><a href="#">About Community</a></li>
					<li><a href="#">SimpleCad Documentation</a></li>
					<li><a href="#">Submit a Ticket</a></li>
					<li><a href="#">FAQ</a></li>
				</ul>
			</div>
		</div>
	</div>
</header>
	<?php require_once "inc/menus/top_nav.php"; ?>