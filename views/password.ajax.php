<?php
	include("controllers/user.controller.php");
	$users=new UserController;
	$json=$users->changePassword($_POST['password'],$_POST['newpassword']);
	echo json_encode($json);
?>