<?php
	include 'lib/User.php';
	include 'inc/header.php';
	Session:: checkAdminSession();
	
 ?>

<?php
	$loginmsg = Session::get("loginmsg");
	if (isset($loginmsg)) {
		echo $loginmsg;
	}
	Session::set("loginmsg", NULL);
?>




	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Student User List <span class="pull-right"><strong>Welcome!</strong> Admin
			</span></h2>

		</div>

		<div class="panel-body">


			<div class="row">
				<?php 
					$user = new Database();

					if(isset($_POST['search'])){
						$searchKey = $_POST['search'];
						$sql = "SELECT *FROM db_table WHERE 
								name LIKE '%".$searchKey."%' OR 
								username LIKE '%".$searchKey."%' OR 
								email LIKE '%".$searchKey."%' ";
					} else {
						$sql = "SELECT * FROM db_table ORDER BY id DESC";
						$searchKey = "";
					}
					
					$query = $user->link->query($sql);
				
				?>

			<form action="" method="POST"> 
					<div class="col-md-6">
						<input type="text" name="search" class='form-control' placeholder="Search Here" value="<?php echo $searchKey; ?>" > 
					</div>
					<div class="col-md-6 text-left">
						<button class="btn">Search</button>
					</div>
				</form>

				<br>
				<br>
			</div>


			<table class="table table-striped">

				<tr>
					<th width="20%">Serial</th>
					<th width="20%">Name</th>
					<th width="20%">User name</th>
					<th width="20%">Email Address</th>
					<th width="20%">Action</th>
				</tr>

<?php
	
	if ($query) {
			$i=0;
		while ($row = mysqli_fetch_object($query)) {
				$i++;
?>
				<tr>
					<td> <?php echo $i; ?>  </td>
					<td> <?php echo $row->name; ?> </td>
					<td> <?php echo $row->username; ?> </td>
					<td> <?php echo $row->email; ?></td>
					<td>
						<a class="btn btn-primary" href="delete.php?id=<?php echo $row->id; ?>">Delete</a>

					</td>
				</tr>
		<?php }}else{ ?>
				<tr><td colspan="5"><h2>No User Data Found .......</h2></td></tr>
		<?php } ?>

			</table>

		</div>

	</div>

	<?php
		include 'inc/footer.php';
	?>
