<?php
        session_start();
        //session_regenerate_id(true);
        error_reporting(E_ALL);
	ini_set("display_errors","true");

	include("libs/framework.lib.php");

	include("vars/titles.var.php");

	
	$p=explode("&",$_SERVER['QUERY_STRING']);
	$p[0]=trim($p[0],'/');
	if($p[0])
	{
		$v="views/".$p[0].".view.php";
		if(!file_exists($v))
		{
			header("HTTP/1.0 404 Not Found");
			$v="views/404.view.php";
		}
	}
	else
	{
		
		$v="views/index.view.php";
	}
	if(isset($titles[$p[0]])){
		$page_title=$titles[$p[0]];
	}
	else
		$page_title=$titles['index'];
	$_SESSION['pageid']=$p[0];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- local -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css"/>
<link rel="stylesheet" type="text/css" href="css/global.css">
<!-- <?
	print_r($_SESSION);
?> -->
<!-- cdn -->
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href='//fonts.googleapis.com/css?family=Comfortaa:400,700,300' />
<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
<?php /*link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300' /> */ ?>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
</head>
<body style="margin: 20px;">

<?php
	include($v);
?>
<div class="container">
	<hr>
	<footer>
        <p>© agendr.eu <?php echo date("Y"); ?> / <a href="index.php?privacy">Privacy</a> / <a href="index.php?terms">Terms</a> / We use <a href="index.php?privacy#cookies">cookies</a> to track site usage.</p>
      </footer>
</div>
<!-- local -->
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/additional-methods.js"></script>

<!-- cdn -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54945-22', 'agendr.eu');
  ga('send', 'pageview');

</script>
</body>
</html>
