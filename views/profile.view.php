<?php
	include("controllers/profile.controller.php");
	
	login_check("index.php");
  
  $pc=new ProfileController;

  $profile=$pc->getProfile();

?>

<div class="container-fluid">
<? include("views/loggedin.nav.frag.php"); ?>
  <div class="row">
  <div class="span6">
    <h2>Change Password</h2>
      <form id="updatepassword_form" action="#" method="post" class="form-horizontal" onsubmit="profile_update();return false;">

          <div class="control-group">
            <label class="control-label" for="user_email">Email</label>
            <div class="controls">
              <input  required id="user_email" type="text" disabled placeholder="My fabulous project" value="<?php echo $profile['user_email']?>"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="user_password">Old password</label>
            <div class="controls">
              <input required id="user_password" type="password" placeholder="Old password"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="user_newpassword">New password</label>
            <div class="controls">
              <input  required id="user_newpassword" type="password" placeholder="New password"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="user_newpassword_confirm">Confirm new password</label>
            <div class="controls">
              <input required id="user_newpassword_confirm" type="password" placeholder="New password"/>
               <p id="register_alert" class="hide"></p>
            </div>
          </div>        
         <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
             
              <button class='btn btn-primary' type='submit'>Update password</button>
            </div>
          </div>        

      </form>
  </div>
  </div>
</div>
<script>

$(document).ready(function(){
  
});

var profile_update=function(){
  password=$("#user_password").val();
  newpassword=$("#user_newpassword").val();
  same=newpassword==$("#user_newpassword_confirm").val();

  if(newpassword.length<6)
  {
    $("#register_alert").text("Enter a password longer than 6 characters");
    $("#register_alert").show();
    return false;
  }


  if(!same)
  {
        $("#register_alert").text("Passwords are not the same");
        $("#register_alert").show();
  }
  else
  {  
      $.post(
      "ajax.php?password",
      {password: $("#user_password").val(),newpassword: $("#user_newpassword").val()},
      function(data){
        $("#register_alert").text(data.message);
        $("#register_alert").show();
        if(!data.error)
        {
          $("#user_newpassword").val("");
          $("#user_newpassword_confirm").val("");
          $("#user_password").val("");
        }
      }
      ,"json"
    );
  }

  return false;
}
</script>