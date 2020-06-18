<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/Session.php';
	Session::init();

?>



<!DOCTYPE html>
<html>
<head>
	<title>Online Admission System</title>
	<link rel="stylesheet" href="inc/bootstrap.min.css"/>
	<script src="inc/jquery.min.js"></script>
	<script src="inc/bootstrap.min.js"></script>
</head>

<?php
	if(isset($_GET['action']) && $_GET['action'] == "logout"){
		Session::destroy();
	}

?>


<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">
						Online Admission System
					</a>
				</div>
				
				<ul class="nav navbar-nav pull-right">
					<?php 

						$adminlogin = Session::get('adminLogin');
						$userlogin = Session::get('login');


						if(!$adminlogin && !$userlogin) :
					?>
					<li><a href="admin.php">Admin Login</a></li>
					<li><a href="profile.php">Student Login</a></li>
					<?php 
					elseif($userlogin && !$adminlogin):?>

						<li><a href="profile.php">Profile</a></li>
					
				<?php
				elseif($adminlogin && !$userlogin): ?>


				<li><a href="index.php">Student User</a></li>
				<li><a href="admin.php">Student Request</a></li>
				<?php 
				endif;
				if($adminlogin || $userlogin):?>
				<li><a href="?action=logout">Logout</a></li>
					<?php 
				endif;?>



				</ul>
			</div>
		</nav>