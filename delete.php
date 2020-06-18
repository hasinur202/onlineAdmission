
<?php
	
	include 'lib/Database.php';
	
 ?>


<?php 
 $id = $_GET['id'];
 $db = new Database();
$query = "DELETE FROM db_table WHERE id=$id";
   $deleteData = $db->delete($query);
 
   header('Location: index.php');

?>

