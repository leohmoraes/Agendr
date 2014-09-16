<?php
	//returns JSON object stating whether user was able to be logged in or not.
	include("controllers/user.controller.php");
	
	$users=new UserController;
	
	$status=$users->forgottenPassword($_POST['email']);
	echo json_encode($status);
?>