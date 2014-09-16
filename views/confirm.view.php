<?
	include($_SERVER['DOCUMENT_ROOT']."/controllers/user.controller.php");
	$users=new UserController;

	$users->confirmUser($_GET['user']);
?>
	
<div class="container">
	<div class="navbar">
		<div class="navbar-inner"> <a class="mainbrand brand" href="/"><span class='brandcol1'>agend</span><span class='brandcol2'>r</span></a>
			<ul class="nav">
				<li class="active"><a href="#">Home</a></li>
				<?php //li><a href="index.php?tour">Tour</a></li?>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="span4"></div>
		<div class="span4">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#login" data-toggle="tab">Login</a></li>
			</ul>
				<div class="tab-pane" id="login">
					<form id="login" action="" method="POST" onsubmit="user_login();return false;">
						<div>
							<input class="span4" type="email" id="login_email" name="login_email" placeholder="Registered Email Address" required/>
						</div>
						<div>
							<input class="span4" type="password" id="login_password" name="login_password" placeholder="Your Password" required/>
						</div>
						<p class="hide" id="login_alert"></p>
						<p> <a href="index.php?password">I've forgotten my password</a> </p>
						<div>
							<input class="btn btn-primary" type="submit" name="Login" value="Login"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/login.js"></script> 
