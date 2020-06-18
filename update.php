<?php 

include 'inc/header.php'; 
include 'lib/Admission.php';


?>

<?php 
 $id = $_GET['id'];
 $db = new Database();
 $query = "SELECT * FROM db_adm WHERE id=".$id;
 $getData = $db->link->query($query)->fetch_object();

if(isset($_POST['update'])){
 $name  = mysqli_real_escape_string($db->link, $_POST['name']);
 $f_name  = mysqli_real_escape_string($db->link, $_POST['fathersname']);
 $m_name = mysqli_real_escape_string($db->link, $_POST['mothersname']);
 $address = mysqli_real_escape_string($db->link, $_POST['address']);
 $gender  = mysqli_real_escape_string($db->link, $_POST['gender']);
 $b_day = mysqli_real_escape_string($db->link, $_POST['bdaymonth']);
 $course = mysqli_real_escape_string($db->link, $_POST['coursename']);
 $payment  = mysqli_real_escape_string($db->link, $_POST['payment']);
 $contact = mysqli_real_escape_string($db->link, $_POST['Contact']);
 
 if ($name == "" OR $f_name == "" OR $m_name == "" OR $address == "" OR $gender == "" OR $b_day == "" OR $course == "" OR $payment == "" OR $contact == ""){
  $error = "Field must not be Empty !!";
 } else {

  $query = "UPDATE db_adm
  SET name = '".$name."', f_name = '".$f_name."', m_name = '".$m_name."', address = '".$address."',gender = '".$gender."',birthdate = '".$b_day."',course   = '".$course."',payment  = '".$payment."',contact  = '".$contact."' WHERE id = ".$id;
  $update = $db->link->query($query);
  if($update){
    header('Location: admin.php');
  } }
  }
  ?>

<?php
  if(isset($_POST['delete'])){
   $query = "DELETE FROM db_adm WHERE id=$id";
   $deleteData = $db->delete($query);
    }
?>
  
<?php 
if(isset($error)){
 echo "<span style='color:red'>".$error."</span>";
}
?>

  <div class="panel panel-default">
    <h2 class="pull-right"><a href="admin.php"><button class="btn btn-primary">Go Back</button></a>
  </div>

<form action="update.php?id=<?php echo $id;?>" method="post">
<table>
  <tr>
  <td>Student Name</td>
  <td><input type="text" name="name" 
  value="<?php echo $getData->name; ?>"/></td>
 </tr>

 <tr>
  <td>Father's Name</td>
  <td><input type="text" name="fathersname" 
  value="<?php echo $getData->f_name; ?>"/></td>
 </tr>

 <tr>
  <td>Mother's Name</td>
  <td><input type="text" name="mothersname"
  value="<?php echo $getData->m_name; ?>"/></td>
 </tr>

 <tr>
  <td>Address</td>
  <td><input type="text" name="address" 
  value="<?php echo $getData->address; ?>"/></td>
 </tr>

 <tr>
  <td>Gender</td>
  <td><input type="text" name="gender" 
  value="<?php echo $getData->gender; ?>"/></td>
 </tr>

 <tr>
  <td>Birht Date</td>
  <td><input name="bdaymonth" 
  value="<?php echo $getData->birthdate; ?>"/></td>
 </tr>

 <tr>
  <td>Course</td>
  <td><input type="text" name="coursename" 
  value="<?php echo $getData->course; ?>"/></td>
 </tr>

 <tr>
  <td>Adavance Payment</td>
  <td><input type="text" name="payment" 
  value="<?php echo $getData->payment; ?>"/></td>
 </tr>

 <tr>
  <td>Contact</td>
  <td><input type="text" name="Contact" 
  value="<?php echo $getData->contact; ?>"/></td>
 </tr>

 <tr>
  <td></td>
  <td>
  <input type="submit" name="update" value="Update"/>
  <input type="reset" Value="Cancel" />
  <input type="submit" name="delete" value="Delete" />
  </td>
 </tr>

</table>
</form>
<br>
<?php include 'inc/footer.php'; ?>