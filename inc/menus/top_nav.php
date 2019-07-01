<nav class="navbar navbar-expand-lg navbar-light bg-light center">
	<div class="container mr-auto">
		<a class="navbar-brand" href="index.php"><?php Helper::getPageName(); ?></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item <?php if($_SERVER['REQUEST_URI'] === ROOT . "index.php"){echo "active";} ?>">
		        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <?php  
		      	if(!Helper::isLoggedin()) {
		      		echo '<li class="nav-item">
		      				<a class="nav-link" href="login.php">Login</a>
					      </li>
					      <li class="nav-item">
					      	<a class="nav-link" href="register.php">Register</a>
					      </li>';
		      	} else {
		      		echo '<li class="nav-item">
					        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
					      </li>';

				     echo '<li class="nav-item">
					        <a class="nav-link" href="dashboard.php">Dashboard<span class="sr-only">(current)</span></a>
					      </li>';
		      	}
		      ?>
		      <?php if($_SERVER['REQUEST_URI'] === ROOT . "setup.php"){
		      	echo '<li class="nav-item active">
				        <a class="nav-link" href="#">Website Setup <span class="sr-only">(current)</span></a>
				      </li>';
		      } ?>
		    </ul>
		  </div>
	</div>
</nav>
