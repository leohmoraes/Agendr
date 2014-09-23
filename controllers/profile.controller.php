<?php

class ProfileController{

	private $db;

	public function __construct(){
		global $db_db,$db_server,$db_user,$db_pass;
		$this->db=new Database($db_db,$db_server,$db_user,$db_pass);	
	}
	
	//Just gets if the user is logged in, then checks the user_id from the session against the database
	public function getProfile(){

		$uid=$_SESSION['loggedin'];
		
		$obj=array('user_id'=>$uid);
		
		return $this->db->fetchRow("what_users",$obj,"*");


	}

}
?>
