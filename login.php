<?php require_once "core/init.php"; ?>
<div class="container ">
	<div class="user-form bg-light text-dark">
		<form action="" method="post">
			<h1 class="text-center">Login</h1>
			<?php  
				if(isset($_GET['user_registerd']) && $_GET['user_registerd'] === 'true') {
					echo '<div class="alert alert-success" role="alert">
							  <h4 class="alert-heading">Well done!</h4>
							  <p>Aww yeah, you successfully registered for the cad system!.</p>
							  <hr>
							  <p class="mb-0">Side note you were sent a registration email go and check it out!</p>
							</div>';
				} 

				if(Helper::isLoggedin()) {
					Helper::Redirect('index');
				}

				$account = new Accounts();
				$account->login();
				if(isset($_GET['user_verify_account'])) {
					$code = $_GET['user_verify_account'];

					$query = DB::getInstance()->update('users', 'user_valid', 1, 'user_code', $code);

					if($query) {
						echo '<div class="alert alert-success" role="alert">
							  <h4 class="alert-heading">Well done!</h4>
							  <p>Aww yeah, you verified your email!.</p>
							  <hr>
							  <p class="mb-0">What are you waiting for login already!</p>
							</div>';
					}
				}
			?>
			<?php Helper::getInput('text', 'username', ['form-control'], 'Username or Email', 'username', 'Username or Email: ') ?>
			<?php Helper::getInput('password', 'password', ['form-control'], 'Password', 'password', 'Password: ') ?>
			<?php Helper::getInput('submit', 'user_login', ['btn', 'btn-dark','btn-block'], 'submit', '', '', 'Login Into ' . SITE_NAME) ?>
			<div class="row">
				<div class="col-md-6 text-center">
					<div class="form-group">Forgot your password? Change it <a href="reset.php">here</a>.</div>
				</div>
				<div class="col-md-6 text-center">
					<div class="form-group">Dont have an account yet? Create one <a href="register.php">here</a>.</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php require_once "inc/footer.php"; ?>