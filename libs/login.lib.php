<?php


//I think this is duplicated in functions.lib.php
function login_check($url){
	if(!isset($_SESSION['loggedin']))
	{
		header("Location: ".$url);		
		die();
	}
}
