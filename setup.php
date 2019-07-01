<?php 

	require_once "core/init.php";

	if(file_exists('config/config.php')) {
		Helper::Redirect("index");
	}

?>

<div class="container bg-light user-form">
	<form action="" method="POST">
		<h1 class="text-center">SimpleCad Configuration Setup</h1>
		<?php Setup::runSetup(); ?>
		<h3 class="section-header">Database Information: </h3>
		<div class="row">
			<div class="col-md-6">
				<?php echo Helper::getInput('text', 'db_host', ['form-control'], 'EX: 127.0.0.1', 'db_host', 'Database Host: '); ?>
			</div>
			<div class="col-md-6">
				<?php echo Helper::getInput('text', 'db_user', ['form-control'], 'EX: root', 'db_user', 'Database Username: '); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php echo Helper::getInput('text', 'db_pass', ['form-control'], 'EX: No Password', 'db_pass', 'Database Password: '); ?>
			</div>
			<div class="col-md-6">
				<?php echo Helper::getInput('text', 'db_name', ['form-control'], 'EX: SimpleCad', 'db_name', 'Database Name: '); ?>
			</div>
		</div>
		<h3 class="section-header">CAD Information: </h3>
		<div class="row">
			<div class="col-md-6">
				<?php echo Helper::getInput('text', 'cad_name', ['form-control'], 'EX: San Andreas Roleplay', 'cad_name', 'Database Host: '); ?>
			</div>
			<div class="col-md-6">
				<label for="verify">Do you want users to be verified be for being added to the CAD?</label>
				<select name="cad_varification" id="verify" class="form-control">
					<option value="noSelect">--- Select an Option ---</option>
					<option value="YES">YES</option>
					<option value="NO">NO</option>
				</select>
			</div>
		</div>
			<?php echo Helper::getTextArea('cad_about', ['form-control'], 'What is you community about?', 'about', "Give a description of your commuity"); ?>
		<h3 class="section-header">Admin Account: </h3>
		<div class="row">
			<div class="col-md-6">
				<?php echo Helper::getInput('text', 'admin_username', ['form-control'], 'EX: Administrator', 'admin_username', 'Admin Username: '); ?>
			</div>
			<div class="col-md-6">
				<?php echo Helper::getInput('text', 'admin_email', ['form-control'], 'EX: admin@youdomain.com', 'admin_email', 'Admin Email: '); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php echo Helper::getInput('password', 'admin_password', ['form-control'], 'EX: Secret Password', 'admin_password', 'Admin Password: '); ?>
			</div>
			<div class="col-md-6">
				<?php echo Helper::getInput('password', 'admin_cpassword', ['form-control'], 'EX: Secret Password', 'admin_cpassword', 'Confirm Password: '); ?>
			</div>
		</div>
			<?php echo Helper::getInput('submit', 'run_setup', ['btn', 'btn-dark', 'btn-block'], $placeholder='', $id='', $label='', $value='Setup CAD'); ?>
		</div>
		
	</form>
</div>

<?php  
	require_once "inc/footer.php";
?>