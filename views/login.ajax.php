<?php
	//returns JSON object stating whether user was able to be logged in or not.
	include("controllers/user.controller.php");
	
	$users=new UserController;
	
	$login=$users->loginUser($_POST['email'],$_POST['password']);
	echo json_encode($login);
?>