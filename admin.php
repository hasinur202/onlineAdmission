<?php
	include 'lib/Admission.php';
	
	include 'inc/header.php';
	
	Session:: checkAdminSession();
	
 ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>View Applicant's Request</h2>
		</div>
		<div class="panel-body">

			<div class="row">
				<?php 
					$user = new Database();

					if(isset($_POST['search'])){
						$searchKey = $_POST['search'];
						$sql = "SELECT *FROM db_adm WHERE 
								name LIKE '%".$searchKey."%' OR 
								f_name LIKE '%".$searchKey."%' OR 
								m_name LIKE '%".$searchKey."%' OR
								address LIKE '%".$searchKey."%' OR
								gender LIKE '%".$searchKey."%' OR
								birthdate LIKE '%".$searchKey."%' OR
								course LIKE '%".$searchKey."%' OR
								payment LIKE '%".$searchKey."%' OR
								contact LIKE '%".$searchKey."%' ";
					} else {
						$sql = "SELECT * FROM db_adm ORDER BY id DESC";
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
					<th width="10%">Serial</th>
					<th width="20%">Name</th>
					<th width="20%">Father's Name</th>
					<th width="20%">Mother's Name</th>
					<th width="20%">Address</th>
					<th width="10%">Gender</th>
					<th width="20%">Birth Date</th>
					<th width="15%">Cours Name</th>
					<th width="15%">Advance Payment</th>
					<th width="20%">Contact</th>
					<th width="15%">Action</th>
	
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
					<td> <?php echo $row->f_name; ?> </td>
					<td> <?php echo $row->m_name; ?></td>
					<td> <?php echo $row->address; ?> </td>
					<td> <?php echo $row->gender; ?></td>
					<td> <?php echo $row->birthdate; ?> </td>
					<td> <?php echo $row->course; ?></td>
					<td> <?php echo $row->payment; ?> </td>
					<td> <?php echo $row->contact; ?></td>

					<td>
						<a class="btn btn-primary" href="update.php?id=<?php echo $row->id; ?>">Edit</a>
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

