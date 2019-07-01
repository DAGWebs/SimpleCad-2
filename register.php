<?php require_once "core/init.php"; ?>
<div class="container ">
	<div class="user-form bg-light text-dark">
		<form action="" method="post">
			<h1 class="text-center">Register</h1>
			<?php $account = new Accounts(); ?>

			<?php  
				if(Helper::isLoggedin()) {
					Helper::Redirect('index');
				}
			?>

			<?php $account->create(); ?>
			<div class="row">
				<div class="col-md-6">
					<?php Helper::getInput('text', 'username', ['form-control'], 'Username', 'username', 'Username') ?>
				</div>
				<div class="col-md-6">
					<?php Helper::getInput('text', 'email', ['form-control'], 'Email', 'email', 'Email: ') ?>
				</div>
			</div>
			
			<?php Helper::getInput('text', 'discord', ['form-control'], 'Discord', 'discord', 'Discord: ') ?>
			
			<div class="row">
				<div class="col-md-6">
					<?php Helper::getInput('password', 'password', ['form-control'], 'Password', 'password', 'Password: ') ?>
				</div>
				<div class="col-md-6">
					<?php Helper::getInput('password', 'cpassword', ['form-control'], 'Confirm Password', 'cpassword', 'Confirm Password: ') ?>
				</div>

			</div>
			
			<label for="signature">Provide you signature if you agree to the <a href="#tos">Terms of Service</a>.</label>
			<div class="input-group mb-3">

			  <div class="input-group-prepend">
			    <div class="input-group-text">
			      <input type="checkbox" aria-label="Checkbox for following text input" name="sig_check">
			    </div>
			  </div>

			  <input type="text" class="form-control cursive" aria-label="Text input with checkbox" name="signature" placeholder="provide signature if you agree to the terms of Service">
			</div>

			<?php Helper::getInput('submit', 'register_account', ['btn', 'btn-dark','btn-block'], 'submit', '', '', 'Register For ' . SITE_NAME) ?>
			<div class="form-group text-center">Already have an account? Login <a href="login.php">here</a>.</div>
		</form>
	</div>
</div>
<?php require_once "inc/footer.php"; ?>