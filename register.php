<?php
	include 'inc/header.php';
	include 'lib/User.php';
	Session:: checkLogin();
 ?>

 <?php 
 	$user = new User();
 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
 		$usrRegi = $user->userRegistration($_POST);
 	}
 ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Registration <a class="pull-right" href="login.php"><button class="btn btn-primary">Back</button></a></h2>
		</div>
		
	<?php
		if (isset($usrRegi)) {
			echo $usrRegi;
		}
	?>


		<div class="panel-body">
			<div style="max-width: 600px; margin: 0 auto">
			<form action="" method="post">
				
				<div class="form-group">
					<label for="name">Your name</label>
					<input type="text" id="name" placeholder="Your Name Here" name="name" class="form-control" />
					
				</div>

				<div class="form-group">
					<label for="username">User name</label>
					<input type="text" id="username" placeholder="Username Here" name="username" class="form-control"  />
					
				</div>

				<div class="form-group">
					<label for="email">Email Address</label>
					<input type="text" id="email" placeholder="<...>@<...>.com" name="email" class="form-control"  />
					
				</div>

				<div class="form-group">
					<label for ="password">Password</label>
					<input type="password" id="password" name="password" class="form-control" />
				</div>

				<div>
					<button type="submit" name="register" class="btn btn-success">Submit</button>
				</div>
			</form>
	</div>
	</div>
	<?php
		include 'inc/footer.php';
	?>

