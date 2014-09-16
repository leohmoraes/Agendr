/* 
(c) Agendr.eu 2013 
Javascript for index.view.php & login.view.php
*/
var user_login=function(){
	//console.log("user_login");
	login_email=$("#login_email").val();
	login_password=$("#login_password").val();

	$("#login_alert").text("Please wait...");
	$.post(
		"ajax.php?login",
		{email: login_email, password: login_password},
		function(data){
			$("#login_alert").text(data.message);
			$("#login_alert").show();
			if(data.login)
				document.location.href=data.url;
		}
		,"json"
	);
}

var user_register=function(){
	//console.log("user_register");
	reg_email=$("#reg_email").val();
	reg_password=$("#reg_password").val();

	
	if(!isEmail(reg_email))
	{
		$("#register_alert_text").text("Not a valid email");
		$("#register_alert").fadeIn();
		return false;
	}

	if(reg_password.length<6)
	{
		$("#register_alert_text").text("Enter a password longer than 6 characters");
		$("#register_alert").fadeIn();
		return false;
	}
	else
	{
		$("#register_alert_text").text("Please wait...");
		$("#register_alert").fadeIn();
		$.post(
			"ajax.php?register",
			{email: $("#reg_email").val(), password: $("#reg_password").val()},
			function(data){
				$("#register_alert_text").text(data.message);
				$("#register_alert").fadeIn();
			}
			,"json"
		);
	}
}



var forgottenEmail=function(){
	if(!isEmail($("#login_email").val()))
	{
		$("#alert_text").text("Please enter a valid email address above.");	
		$("#forgotten_alert").addClass("alert-error");
		$("#forgotten_alert").fadeIn();
	}	
	else
	{
		$.post(
			"ajax.php?forgotten",
			{
				email: $("#login_email").val(),
			},
			function(data){
				$("#forgotten_alert").removeClass("alert-error");
				$("#alert_text").text(data.message);
				$("#forgotten_alert").fadeIn();
			}
			,"json"
		);
	}
}