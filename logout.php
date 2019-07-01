<?php require_once "core/init.php"; ?>
<?php  
	Session::delete('user_is_loggedin');

	Helper::Redirect('login',"?user_logged_out");
?>
<?php require_once "inc/footer.php"; ?>