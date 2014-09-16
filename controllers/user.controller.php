<?php
include("libs/mail.lib.php");
require("libs/password.php");

class UserController{

	private $db;
	private $mailer;

	static function fix_tags(&$item,$key){
		$item=strip_tags($item);
	}

	public function __construct(){
		global $db_db,$db_server,$db_user,$db_pass;
		$this->db=new Database($db_db,$db_server,$db_user,$db_pass);	
		$this->mailer=new Mailer;
	}

	// check user is OK to log in, and set up session for user
	public function loginUser($email,$password){
		$userobj=array(
			'user_email'=>$email
		);
		
		$row=$this->db->fetchRow("what_users",$userobj,"*");
		
		$returnobj=array();
		
		if(password_verify($password,$row['user_password']))
		{
			if($row['user_confirmed']==1)
			{
				$returnobj['login']=true;
				$returnobj['message']="Login OK";
				$returnobj['url']="dashboard";
				$_SESSION['loggedin']=$row['user_id'];
				$_SESSION['apikey']=$row['user_id'];
				$_SESSION['maxprojects']=$row['user_maxprojects'];
			}
			else
			{
				$returnobj['login']=false;
				$returnobj['message']="You need to confirm your email address.";
				$returnobj['url']="/";
				$_SESSION['loggedin']=0;
				$_SESSION['apikey']="";
			}
		}
		else
		{
			$returnobj['login']=false;
			$returnobj['message']="Incorrect username/password.";
			$returnobj['url']="/";
			$_SESSION['loggedin']=0;
			$_SESSION['apikey']="";
		}
		return $returnobj;
	}

	public function changePassword($password,$newpassword){
		$userobj=array(
			'user_id'=>$_SESSION['loggedin']
		);
		
		$returnobj=array();
		
		$row=$this->db->fetchRow("what_users",$userobj,"user_password,user_salt");

		
		$newhash=password_hash($newpassword,PASSWORD_DEFAULT);
		
		if(password_verify($password,$row['user_password']))
		{
			$returnobj['error']=false;
			$returnobj['message']="Password changed.";
			$this->db->updateQuery("what_users",array('user_password'=>$newhash),$userobj);
		}
		else
		{
			$returnobj['error']=true;
			$returnobj['message']="Incorrect old password.";
		}
		return $returnobj;
	}
	
	// insert user into table if user exists
	// email is a UNIQUE in the table
	// so we will only add in if it doesn't exist.
	public function registerUser($email,$password){
	
		$password=password_hash($password,PASSWORD_DEFAULT);
		
		$userobj=array(
			'user_email'=>strip_tags($email),
		);
		
		$returnobj=array();
		
		$row=$this->db->fetchRow("what_users",$userobj,"*");
		if($row){
			$returnobj['error']=1;	
			$returnobj['message']="That email address is already in use.";
			return $returnobj;
		}
		
		$userobj=array(
			'user_email'=>$email,
			'user_password'=>$password,
			'user_apikey'=>uniqueid($email)
		);
		
		$this->db->insertQuery("what_users",$userobj);
		
		$returnobj['error']=0;	
		$returnobj['message']="Please check your email to confirm your registration.";
		
		$urlobj=array('url'=>"http://".$_SERVER['HTTP_HOST']."/index.php?confirm&user=".$userobj['user_apikey']);
		
		$this->mailer->sendTemplateMail($_SERVER['DOCUMENT_ROOT']."/emails/register.txt",$email,"Your agendr.eu Registration",$urlobj);
		
		return $returnobj;	
	}

	//reset password and send it to the user.
	public function forgottenPassword($email){

		$userobj=array(
			'user_email'=>$email,
		);
		
		$returnobj=array();
		
		
		$row=$this->db->fetchRow("what_users",$userobj,"*");
		if(!$row){
			$returnobj['error']=1;	
			$returnobj['message']="That email address is not registered.";
			return $returnobj;
		}
		
		$npassword=uniqid();
		$password=password_hash($npassword,PASSWORD_DEFAULT);

		$userobj=array(
			'user_password'=>$password,
		);
		
		$this->db->updateQuery("what_users",$userobj,array('user_email'=>$email));
		
		$returnobj['error']=0;	
		$returnobj['message']="Please check your email to get your new password.";
		
		$urlobj=array('password'=>$npassword);
		
		$this->mailer->sendTemplateMail($_SERVER['DOCUMENT_ROOT']."/emails/password.txt",$email,"Your agendr.eu password has been reset.",$urlobj);
		
		return $returnobj;	
	}
	
	//confirm a user
	public function confirmUser($apikey){
		$userobj=array('user_confirmed'=>1);
		$whereobj=array('user_apikey'=>$apikey);
		return $this->db->updateQuery("what_users",$userobj,$whereobj);	
	}
}

?>