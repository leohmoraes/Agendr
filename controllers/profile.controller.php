<?php

class ProfileController{

	private $db;

	public function __construct(){
		global $db_db,$db_server,$db_user,$db_pass;
		$this->db=new Database($db_db,$db_server,$db_user,$db_pass);	
	}
	
	public function getProfile(){

		$uid=$_SESSION['loggedin'];
		
		$obj=array('user_id'=>$uid);
		
		return $this->db->fetchRow("what_users",$obj,"*");


	}

}
?>