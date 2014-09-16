<?php
	include("controllers/user.controller.php");
	$users=new UserController;
	$json=$users->registerUser($_POST['email'],$_POST['password']);
	echo json_encode($json);
?>