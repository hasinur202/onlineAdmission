<?php 

	include_once 'Session.php';
	include 'Database.php';

class Admission{
	private $db;
		function __construct()
			{
			$this->db = new Database();
			}
	public function addmissionApply($data){
			
		$name 		= $data['name'];
		$f_name 	= $data['fathersname'];
		$m_name 	= $data['mothersname'];
		$address 	= $data['address'];
		$gender 	= $data['gender'];
		$b_day 		= $data['bdaymonth'];
		$course 	= $data['cousename'];
		$payment 	= $data['payment'];
		$contact 	= $data['Contact'];


		if ($name == "" OR $f_name == "" OR $m_name == "" OR $address == "" OR $gender == "" OR $b_day == "" OR $course == "" OR $payment == "" OR $contact == ""){
			$msg = '<div class="alert alert-danger"><strong>Error!</strong>Field must not be empty! </div>';
			return $msg;
		}


		$sql = "INSERT INTO db_adm (name, f_name, m_name, address, gender, birthdate, course, payment, contact) VALUES('".$name."','".$f_name."', '".$m_name."', '".$address."', '".$gender."', '".$b_day."', '".$course."', '".$payment."', '".$contact."')";
	
			$query = $this->db->link->query($sql);

			if ($query) {
				$msg = '<div class="alert alert-success"><strong>Success!</strong>Thank you! your application has been submitted</div>';
				return $msg;
				}
			else{
				$msg = '<div class="alert alert-success"><strong>Sorry!</strong>There has been problem inserting your details!</div>';
				return $msg;
				}

	}


}