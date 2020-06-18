<?php
	include 'inc/header.php';
	include 'lib/Admission.php';
 ?>

 <?php 
 	$user = new Admission();
 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
 		$usrRegi = $user->addmissionApply($_POST);
 	}
 ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2> 

				Admission Form
				<span class="pull-right"><strong><h3> 
			<?php
				$name = Session::get("name");
				if (isset($name)) {
					echo $name;
				}?></span></strong></h3></h2>
				<br> 
				<h2 class="pull-right"><a href="profile.php"><button class="btn btn-primary">Go Back</button></a></h2>
				
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
					<label for="fathername">Student Name</label>
					<input type="text" placeholder="Type your name" id="name" name="name" class="form-control" />
					
				</div>

				<div class="form-group">
					<label for="fathername">Father's Name</label>
					<input type="text" placeholder="Type your father's name" id="fathername" name="fathersname" class="form-control" />
					
				</div>

				<div class="form-group">
					<label for="mothersname">Mother's Name</label>
					<input type="text" placeholder="Type your mother's name" id="mothersname" name="mothersname" class="form-control"  />
					
				</div>

				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" placeholder="Type your address where you live" id="address" name="address" class="form-control"  />
					
				</div>


				<div class="form-group">
					<label for="gender">Gender</label> <br>
					<div class="custom-radio">
						<input type="radio" name="gender" value="male" checked> Male<br>
  						<input type="radio" name="gender" value="female"> Female<br>
  						<input type="radio" name="gender" value="other"> Other
					</div>
				</div>

				<div class="form-group">
					<label for="email">Birth Date</label>
					
  						<input type="date" class="form-control" name="bdaymonth">
						
					
				</div>

				<div class="form-group">
					<label for="email">Course Name</label>
					<select class="form-control" name="cousename">
						<option>Select Course Name</option>
						<option value="PHP">PHP (1500 tk)</option>
						<option value="JAVA">JAVA (2000 tk)</option>
						<option value="HTML">HTML (1000 tk)</option>
						<option value="LARAVEL">LARAVEL (3000 tk)</option>
					</select>
					
				</div>

				<div class="form-group">
					<label for="payment">Advance Payment</label>
					<input type="text" placeholder="XXXX TK" id="payment" name="payment" class="form-control"  />
				</div>

				<div class="form-group">
					<label for="Contact">Contact No.</label>
					<input type="text" placeholder="01XXX XXXXXX" id="Contact" name="Contact" class="form-control"  />
				</div>


				<div>
					<button type="submit" name="register" class="btn btn-success">Submit</button>
					<button type="reset" name="Cancel" class="btn btn-primary">Cancel</button> 
				</div>
			</form>
	</div>
	</div>
	<?php
		include 'inc/footer.php';
	?>

