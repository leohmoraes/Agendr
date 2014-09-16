<?php
	
	ini_set("display_errors","true");
	session_start();
        error_reporting(E_ALL);

	include("libs/framework.lib.php");

	
	$p=$_SERVER['QUERY_STRING'];
	if($p)
	{
		$v="views/".$p.".ajax.php";
		if(!file_exists($v))
			$v="views/404.view.php";
	}
	else
		$v="views/index.view.php";

	include($v);

?>
