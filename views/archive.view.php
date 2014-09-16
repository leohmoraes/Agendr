<?php

	//include($_SERVER['DOCUMENT_ROOT']."/controllers/profile.controller.php");
	
	login_check("index.php");
  
  //$pc=new Controller;

?>

<div class="container-fluid">
<? include("views/loggedin.nav.frag.php"); ?>
<div class="row">
  <div class="span6"> 
    <table class="table">
      <thead>
        <th>Project</th>
        <th>Start</th>
        <th>Due</th>
        <th>Status</th>
        <th>&nbsp;</th>
      </thead>
      <tbody id="projectList">
      </tbody>
    </table>
  </div>
  <div class="span6"> 
    
    <table class="table">
      <thead>
      
        <th>Milestone</th>
        <th>Due</th>
        </thead>
     <tbody id="milestoneList">
      </tbody>
    </table>
  </div>


</div>
<script type="text/javascript"  src="js/archive.js"></script> 