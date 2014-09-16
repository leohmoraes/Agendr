<?php
/* 

(c) Agendr.eu 2013 
General PHP function

*/

/* 	check for login session variable 
	$url - return URL if login doesn't exist
*/
function login_check($url){
	if(!isset($_SESSION['loggedin']))
	{
		header("Location: ".$url);		
		die();
	}
}
	
/* Generate a unique ID pulling some unique data from the system variables */
function uniqueid($seed=""){

	$data=$seed;
	$data.=uniqid();
	$data.=$_SERVER['HTTP_USER_AGENT'];
	$data.=$_SERVER['SERVER_ADDR'];
	$data.=$_SERVER['REMOTE_ADDR'];
	$data.=$_SERVER['REQUEST_TIME'];
	$data.=$_SERVER["REMOTE_PORT"];
	$data=hash('sha256',$data);
	return $data;
}

