<?php require_once "core/init.php"; ?>
<div class="container ">
	<div class="user-form bg-light text-dark">
		<?php  
			if(Helper::isLoggedin()) {
				Helper::Redirect('index', "?user_already_logged_in");
			}
			if(isset($_GET['reset_user']) && isset($_GET['reset_code'])) {
				$user = $_GET['reset_user'];
				$code = $_GET['reset_code'];

				$query = DB::getInstance()->select('users', 'user_code', $code);

				if(DB::getInstance()->rows($query) == 1) {
					?>
						<form action="" method="post">
							<h1 class="text-center">Change Password</h1>
							<?php $account = new Accounts(); ?>
							<?php $account->changePassword(); ?>
							<?php Helper::getInput('password', 'password', ['form-control'], 'New Password', 'password', 'New Password: ') ?>
							<?php Helper::getInput('password', 'cpassword', ['form-control'], 'Confirm New Password', 'cpassword', 'Confirm New Password: ') ?>
							<input type="hidden" value="<?php echo $code ?>" name="code">
							<?php Helper::getInput('submit', 'change_password', ['btn', 'btn-dark','btn-block'], 'submit', '', '', 'Change Password') ?>
							<div class="row">
								<div class="col-md-6 text-center">
									<div class="form-group">Remebered your password? Login <a href="login.php">here</a>.</div>
								</div>
								<div class="col-md-6 text-center">
									<div class="form-group">Dont have an account yet? Create one <a href="register.php">here</a>.</div>
								</div>
							</div>
						</form>
					<?php
				} else {
					echo  '<div class="alert alert-danger text-center" role="alert"> Sorry but something went wrong please try again.</div>';
				}
				
			} else {
				?>

				<form action="" method="post">
					<h1 class="text-center">Reset Password</h1>
					<p class="text-center text-danger form-group">
						<small>
							If your username and email match what we have registered for your account we will send you an email to reset your password.
						</small>
					</p>
					<?php $account = new Accounts(); ?>
					<?php $account->reset(); ?>
					<?php Helper::getInput('text', 'username', ['form-control'], 'Account Username', 'username', 'Account Username: ') ?>
					<?php Helper::getInput('text', 'email', ['form-control'], 'Account Email', 'email', 'Account Email: ') ?>
					<?php Helper::getInput('submit', 'reset_password', ['btn', 'btn-dark','btn-block'], 'submit', '', '', 'Reset Password') ?>
					<div class="row">
						<div class="col-md-6 text-center">
							<div class="form-group">Remebered your password? Login <a href="login.php">here</a>.</div>
						</div>
						<div class="col-md-6 text-center">
							<div class="form-group">Dont have an account yet? Create one <a href="register.php">here</a>.</div>
						</div>
					</div>
				</form>

				<?php
			}
		?>
	</div>
</div>
<?php require_once "inc/footer.php"; ?>