<?php
	
	include_once 'Session.php';
	include 'Database.php';

	class User{
		private $db;
		function __construct()
			{
			$this->db = new Database();
			}
	public function userRegistration($data){
		$name 		= $data['name'];
		$username 	= $data['username'];
		$email 		= $data['email'];
		$password 	= $data['password'];

		$checkEmail = $this->emailCheck($email);


		if ($name == "" OR $username == "" OR $email == "" OR $password == ""){
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Field must not be empty! </div>';
			return $msg;
		}

		if (strlen($username) < 3) {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> User name is too short! </div>';
			return $msg;
		}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Username must contain only alphanumerical, dashes and underscore! </div>';
			return $msg;
		}

		if (strlen($password) < 5) {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Password must be minimum 5 digit </div>';
			return $msg;
		}

		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Ivalid email! </div>';
			return $msg;
		}

		if ($checkEmail == true) {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Email Address already exist! </div>';
			return $msg;
		}


		$password 	= md5($data['password']);
		$sql = "INSERT INTO db_table (name, username, email, password) VALUES('".$name."', '".$username."', '".$email."', '".$password."')";
			$query = $this->db->link->query($sql);

			if ($query) {
				$msg = '<div class="alert alert-success"><strong>Success!</strong> Thank you! you have been registered</div>';
				return $msg;
				}
				
			else{
				$msg = '<div class="alert alert-success"><strong> Sorry!</strong> There has been problem inserting your details!</div>';
				return $msg;
				}
	}

	public function getLoginUser($email, $password){
		$sql = "SELECT * FROM db_table WHERE email = '".$email."' AND password = '".$password."' LIMIT 1";
		$query = $this->db->link->query($sql);
		$result = $query->fetch_object();
		return $result;

	}

	// public function getUserData(){
	// 	$sql = "SELECT * FROM db_table ORDER BY id DESC";
	// 	$query = $this->db->link->query($sql);
	// 	// $query->execute();
	// 	return $query;
	// }


	public function emailCheck($email){
		$sql = "SELECT email FROM db_table WHERE email = '".$email."'";
		$query = $this->db->link->query($sql);

		if ($query->num_rows > 0) {
			return true;
		}else{
			return false;
		}
	}

	

	public function getUserById($userid){
		$sql = "SELECT * FROM db_table WHERE id = '".$userid."' LIMIT 1";
		$query = $this->db->link->query($sql);
		$result = $query->fetch_object();
		return $result;

	}


	public function checkPassword($id, $old_pass){
		$password = md5($old_pass);
		$sql = "SELECT password FROM db_table WHERE id = '".$id."' AND password = '".$password."'";
		$query = $this->db->link->query($sql);

		if ($query->num_rows > 0) {
			return true;
		}else{
			return false;
		}
	}


	public function updatePassword($id, $data){
		$old_pass = $data['Old_pass'];
		$new_pass = $data['password'];
		$chk_pass = $this->checkPassword($id, $old_pass);


		if ($old_pass == "" OR $new_pass == "") {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Field must not be empty! </div>';
			return $msg;
		}

			if ($chk_pass == false) {
				$msg = '<div class="alert alert-danger"><strong>Error!</strong> Old Password not exit! </div>';
			return $msg;
			}

			if (strlen($new_pass) < 4) {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Password is too short! </div>';
			return $msg;
			}

			$password = md5($new_pass);
			$sql = "UPDATE db_table set 
			password	= '".$password."' 
			WHERE id 	= '".$id."'";

		$query = $this->db->link->query($sql);

		if ($query) {
			$msg = '<div class="alert alert-success"><strong>Success! </strong> Update Password successfully!</div>';
			return $msg;
		}
		else{
			$msg = '<div class="alert alert-success"><strong>Sorry!</strong> There has been problem updating your Password!</div>';
			return $msg;
		}
	}


	public function updateUserData($id, $data){
		$name 		= $data['name'];
		$username 	= $data['username'];
		$email 		= $data['email'];


		if ($name == "" OR $username == "" OR $email == ""){
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Field must not be empty! </div>';
			return $msg;
		}


		$sql = "UPDATE db_table set name = '".$name."', username = '".$username."',email = '".$email."' WHERE id = '".$id."'";

		$result = $this->db->link->query($sql);

		if ($result) {
			$msg = '<div class="alert alert-success"><strong>Success! </strong> Update profile successfully!</div>';
			return $msg;
		}
		else{
			$msg = '<div class="alert alert-success"><strong>Sorry!</strong> There has been problem updating your details!</div>';
			return $msg;
		}
	}


	public function userLogin($data){
		$email = $data['email'];
		$password = md5($data['password']);
		$checkEmail = $this->emailCheck($email);

		if ($email == "" OR $password == "") {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Field must not be empty! </div>';
			return $msg;
		}

		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Ivalid email! </div>';
			return $msg;
		}

		if ($checkEmail == false) {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Email Address not exist! </div>';
			return $msg;
		}

		$result = $this->getLoginUser($email, $password);
		if ($result) {
			Session::init();
			Session::set("login", true);
			Session::set("id", $result->id);
			Session::set("name", $result->name);
			Session::set("username", $result->username);
			Session::set("loginmsg", '<div class="alert alert-success"><strong> Success! </strong>You are LoggedIn! </div>');
			header("Location: profile.php");
		}else{
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Data not found! </div>';
			return $msg;
		}

	}


// Admin Function start from here


public function getLoginAdmin($adm_username, $adm_password){
		$sql = "SELECT * FROM adminlogin WHERE adm_username = '".$adm_username."' AND adm_password = '".$adm_password."'";
		$query = $this->db->link->query($sql);
		$result = $query->fetch_object();
		// return $result;
		if ($query->num_rows > 0) {
			return true;
		}else{
			return false;
		}

	}


	public function adminLogin($data){
		$adm_username = $data['adm_username'];
		$adm_password = $data['adm_password'];

		if ($adm_username == "" OR $adm_password == "") {
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Field must not be empty! </div>';
			return $msg;
		}

		$result = $this->getLoginAdmin($adm_username, $adm_password);
		if ($result) {
			Session::init();
			Session::set("adminLogin", true);
			Session::set("id", $result->id);
			Session::set("adm_username", $result->adm_username);
			Session::set("loginmsg", '<div class="alert alert-success"><strong> Success! </strong>You are LoggedIn! </div>');
			header("Location: index.php");
		}else{
			$msg = '<div class="alert alert-danger"><strong>Error!</strong> Data not found! </div>';
			return $msg;
		}

	}


	}
?>