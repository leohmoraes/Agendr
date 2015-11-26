<style>
@media all and (min-width: 320px) and (max-width: 980px) {
	.hero-unit{background-position: left;}
};
@media all and (min-width: 980px) { 
	.hero-unit{background-position: right;}
};


</style>
<div class="container">
	<!-- div class="alert">NOTE: Site is for demonstration purposes, data may be deleted, site is not encrypted.</div -->
	<div class="navbar">
		<div class="navbar-inner"> <a class="mainbrand brand" href="\"><span class='brandcol1'>agend</span><span class='brandcol2'>r</span></a>
			<ul class="nav pull-right">
				<li ><a href="https://agendr.uservoice.com/" target="_blank">Feedback</a></li>
			</ul>
		</div>
	</div>
	<div class="hero-unit">
		<div class="hero-text">
			<h1>Organise your work anywhere</h1>
			<ul class="icons-ul">
				<li><i class="icon-li icon-eye-open"></i>Single view of your tasks</li>
				<li><i class="icon-li icon-dashboard"></i>Simple intuitive dashboard</li>
				<li><i class="icon-li icon-tasks"></i>All your deadlines on any web device</li>
				<!--li><i class="icon-li icon-globe"></i>Built for freelancers</li-->
			</ul>
		</div>
	
	</div>
	<div class="row">
		<div class="span4">
			<ul class="nav nav-tabs">
				<li class="active"> <a href="#reg" data-toggle="tab">Register</a> </li>
				<li><a href="#login" data-toggle="tab">Login</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="reg">
					<form id="register" action="#" onsubmit="user_register();return false;" method="POST">
						<div>
							<input class="span4" type="email" id="reg_email" name="reg_email" placeholder="Email Address" required/>
						</div>
						<div>
							<input class="span4" type="password" id="reg_password" name="reg_password" placeholder="Password (6 characters or more)" required/>
						</div>
                        <div id="register_alert" class="alert  alert-block hide"><button type="button" class="close" onclick="$(this).parent().fadeOut()">&times;</button><span id="register_alert_text"></span></div>
						<div>
							<input class="btn btn-success btn-large" name="register" type="submit" value="Register for Free" />
						</div>
					</form>
				</div>
				<div class="tab-pane" id="login">
					<form id="login" action="" method="POST" onsubmit="user_login();return false;">
						<div>
							<input class="span4" type="email" id="login_email" name="login_email" placeholder="Registered Email Address" required/>
						</div>
						<div>
							<input class="span4" type="password" id="login_password" name="login_password" placeholder="Your Password" required/>
						</div>
						<p class="hide" id="login_alert"></p>
						<p> <a href="#" onclick="forgottenEmail()">I've forgotten my password</a> </p>
                        <div id="forgotten_alert" class="alert hide"><span id="alert_text"></span><button type="button" class="close" onclick="$(this).parent().fadeOut()">&times;</button></div>
						<div>
							<input class="btn btn-primary" name="Login" type="submit" value="Login"/>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="span2 bucket-text">
        	<h3>Inexpensive</h3>
        	<p>It costs you <strong>nothing</strong> to track up to 10 personal projects. More projects and teams are available from $5 per month (coming soon).</p>
        </div>
		<div class="span2 bucket-text">
        	<h3>Secure</h3>
        	<p>Everything is done over HTTPS and SSL - the same technology banking websites use.</p>
        </div>
		<div class="span2 bucket-text">
        	<h3>Available</h3>
        	<p>agendr will work on almost all tablets and smartphones - access your data anywhere.</p>
        </div>
		<div class="span2 bucket-text">
        	<h3>Dynamic</h3>
        	<p>agendr is adaptable - print to any size paper - view on any sized screen</p>
        </div>
	</div>
</div>
<script type="text/javascript" src="js/login.js"></script> 
