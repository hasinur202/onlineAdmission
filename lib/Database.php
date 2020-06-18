<?php

class Database {
	private $hostdb = "localhost";
	private $userdb = "root";
	private $passdb = "";
	private $namedb = "db_lr";
	
	public $link;
	public $error;

	
	public function __construct(){
	
		$this->connectDB();
	}


	private function connectDB(){
 		$this->link = new mysqli($this->hostdb, $this->userdb, $this->passdb, $this->namedb);
 		if(!$this->link){
   			$this->error ="Connection fail".$this->link->connect_error;
  			return false;
 		}
	}


   
// // Update data
 public function update($query){
 $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
 if($update_row){
  header("Location: index.php?msg=".urlencode('Data updated successfully!'));
   exit();
 } else {
   die("Error: (".$this->link->errno.")".$this->link->error);
 }
}


// // Delete data
 public function delete($query){
    $delete_row = $this->link->query($query) or 
    die($this->link->error.__LINE__);
    if($delete_row){
      header("Location: admin.php? msg=".urlencode('Data deleted successfully!'));
       exit();
    } else {
      die("Error: (".$this->link->errno.")".$this->link->error);
    }
    }

// // search data
 public function search($query){
    $search_row = $this->link->query($query) or 
    die($this->link->error.__LINE__);
    if($search_row){
      header("Location: admin.php? msg=".urlencode('Data found successfully!'));
       exit();
    } else {
      die("Error: (".$this->link->errno.")".$this->link->error);
    }
    }	



}




?>