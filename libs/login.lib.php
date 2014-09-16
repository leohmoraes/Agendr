<?php

function login_check($url){
	if(!isset($_SESSION['loggedin']))
	{
		header("Location: ".$url);		
		die();
	}
}