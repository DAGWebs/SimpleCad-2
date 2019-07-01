<footer class="bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-6">
				<p class="text-light">SimpleCad <small>Developed by: <a href="#">dTech Development</a></small></p>
			</div>
			<div class="col-6">

				<p class="text-light text-center">copyright &copy; 
					<?php if($_SERVER['PHP_SELF'] !== ROOT . 'setup.php') {
						echo "2019 " . SITE_NAME;
					} else {
						echo "2019 SimpleCad";
					} ?>
				</p>
			</div>
		</div>
	</div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>