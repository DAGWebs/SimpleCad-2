<?php require_once "core/init.php"; ?>
<div class="row top-50">
	<div class="col-md-8" style="margin-bottom: 20px;">
		<div class="bg-light" style="border-radius: 10px 10px 0 0; box-shadow: 10px 10px 10px black;">
			<h2 class="text-center"><?php echo SITE_NAME ?></h2>
			<div class="bg-dark text-light" style="padding: 10px;">
				<?php echo SITE_DESC; ?>
			</div>
		</div>
		
	</div>
	<div class="col-md-4" style="margin-bottom: 10px;">
		<div class="bg-dark text-light" style="border-radius: 10px 10px 0 0; box-shadow: 10px 10px 10px black;">
			<h2><?php echo SITE_NAME ?> Announcments</h2>
			<div class="bg-light" style="padding: 16px;">
				<?php  
					$query = DB::getInstance()->select('announcments');

					if(DB::getInstance()->rows($query) > 0) {
						while($row = DB::getInstance()->assoc($query)) {
							echo '<div class="alert alert-' . $row['ann_type'] . '" role="alert">
							  	' . $row['ann_message'] . '
							 </div>';
						}
					} else {
						echo '<div class="alert alert-danger" role="alert">
							No updates availible.
						</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php require_once "inc/footer.php"; ?>