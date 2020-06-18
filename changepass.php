<?php
	include 'lib/user.php';
	include 'inc/header.php';
	Session:: checkSession();
 ?>

 <?php
 	if (isset($_SESSION['id']) && !isset($_GET['id'])) {
 		$userid = (int)$_SESSION['id'];
 		$sesId = Session::get("id");
 		if ($userid!= $sesId) {
 			header("Location: index.php");
 		}
 	}else{
		$userid = (int)$_GET['id'];
 	}
 	
 	$user = new User();
 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])) {
 		$updatepass = $user->updatePassword($userid, $_POST);
 	}
 ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Change Password <a class="pull-right" href="profile.php"><button class="btn btn-primary">Back</button></a></h2>
		</div>

		<div class="panel-body">
			<div style="max-width: 600px; margin: 0 auto">

	<?php
		if (isset($updatepass)) {
			echo $updatepass;
		}
	?>

			<form action="" method="post">
				<div class="form-group">
					<label for="Old_pass">Old Password</label>
					<input type="password" id="Old_pass" name="Old_pass" class="form-control" ?>
					
				</div>

				<div class="form-group">
					<label for="password">New Password</label>
					<input type="password" id="password" name="password" class="form-control"?>
					
				</div>

				<button type="submit" name="updatepass" class="btn btn-success">Update</button>
				
			</form> 
	</div>
	</div>
	<?php
		include 'inc/footer.php';
	?>
