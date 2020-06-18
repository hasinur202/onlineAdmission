<?php
	include 'inc/header.php';
	include 'lib/User.php';
	Session::checkadminLogin();
 ?>


	<div style="max-width: 600px; margin: 0 auto">
		<form action="" method="post">

 <?php 
 	$user = new User();
 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adminLogin'])) {
 		//$a = $user->adminLogin($_POST['adm_username'], $_POST['adm_password']);
 		$a = $user->adminLogin($_POST);
 		
 	}
 ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Admin Login</h2>
		</div>
		
	<?php
		if (isset($a)) {
			echo $a;
		}?>

		<div class="panel-body">
				<div class="form-group">
					<label for="adm_username">Admin Name</label>
					<input type="text" id="adm_username" name="adm_username" class="form-control" ?> 
				</div>


				<div class="form-group">
					<label for ="password">Password</label>
					<input type="password" id="adm_password" name="adm_password" class="form-control" />
				</div>

				<div>
					<button type="submit" name="adminLogin" class="btn btn-success">Login</button>
				</div>
			</form>
	</div>
	</div>
	
</div>
	<?php
		include 'inc/footer.php';
	?>
