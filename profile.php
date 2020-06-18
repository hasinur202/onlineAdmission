<?php
	include 'lib/user.php';
	include 'inc/header.php';
	Session:: checkSession();
 ?>


<?php
	$loginmsg = Session::get("loginmsg");
	if (isset($loginmsg)) {
		echo $loginmsg;
	}
	Session::set("loginmsg", NULL);
?>
 

 <?php
 	if (isset($_SESSION['id']) && !isset($_GET['id'])) {
 		$userid = (int)$_SESSION['id'];
 	}else{
		$userid = (int)$_GET['id'];
 	}
 	
 	$user = new User();
 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
 		$updateusr = $user->updateUserData($userid, $_POST);
 	}
 ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2> <strong>
			<?php
				$name = Session::get("username");
				if (isset($name)) {
					echo $name;
				}?></strong>'s Profile 



			 <a href="apply.php"><span class="pull-right">Apply for Admission</span></a></h2>
		
		</div>

	
	

		<div class="panel-body">
			<div style="max-width: 600px; margin: 0 auto">

	<?php
		if (isset($updateusr)) {
			echo $updateusr;
		}
	?>

	
	<?php
		$userdata = $user->getUserById($userid);
		if ($userdata) {
	?>
			<form action="" method="post">
				<div class="form-group">
					<label for="name">Your name</label>
					<input type="text" id="name" name="name" class="form-control" value="<?php echo $userdata->name; ?>" />
					
				</div>

				<div class="form-group">
					<label for="username">User name</label>
					<input type="text" id="username" name="username" class="form-control" value="<?php echo $userdata->username; ?>"/>
					
				</div>

				<div class="form-group">
					<label for="email">Email Address</label>
					<input type="text" id="email" name="email" class="form-control" value="<?php echo $userdata->email; ?>" />
				</div>

				<?php
					$sesId = Session::get("id");
					if ($userid == $sesId) {
			
				?>
				
				<button type="submit" name="update" class="btn btn-success">Update</button>
				<a class="btn btn-info" href="changepass.php?id = <?php echo $userid;?>">Password Change</a>

			<?php } ?>
				
			</form> <?php  } ?>
	</div>
	</div>
	<?php
		include 'inc/footer.php';
	?>
