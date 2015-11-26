<?php
	//include("libs/login.lib.php");
	
	login_check("index.php");
  
?>
<div class="container-fluid">
<? include("views/loggedin.nav.frag.php"); ?>
<style>

  h3{line-height:  20px}

  td .label{
    white-space: normal;
    width: 100%;
    display: inline-block;
    text-align: center;
  }
</style>
<!-- div class="alert">
        IMPORTANT - THIS SITE WILL CLOSE ON MARCH 31st 2014 YOUR DATA AND USER ACCOUNT WILL BE DELETED
</div -->

<div class="alert alert-info alert-block hide" id="alert_noprojects"><a href="#" class="close" data-dismiss="alert">&times;</a><p>Thank you for registering with agendr.eu.</p><p>You have no projects, you can add one using the +Project button</p></div>
<div class="row-fluid">
  <div class="span6"> 
    <h3>Projects <span id="project_number"></span></h3>
  <div class="alert" id="project_spinner"><img src="images/spinner.gif"  /> Loading projects.</div>
    <table class="table">
      <thead>
        <th>Project</th>
        <th>Start</th>
        <th>Due</th>
        <th>&nbsp;</th>
      </thead>
      <tbody id="projectList">

      </tbody>
    </table>
   <a id="addProject_button" href="#addProjectModal" class="btn btn-info" role="button" data-toggle="modal"><i class="icon-plus icon-white"></i> Project</a>
  <div class="alert alert-warning hide" id="project_alert"></div>
  </div>
  <div class="span6"> 
    <h3>Agenda</h3>
    <div class="alert" id="milestone_spinner"><img src="images/spinner.gif"  /> Loading milestones.</div>
    <table class="table">
      <thead>
        <th></th>  
        <th>Milestone</th>
        <th>Due</th>
        <th>&nbsp;</th>
        </thead>
     <tbody id="milestoneList">
      
      </tbody>
    </table>
    <div class="pagination  pagination-centered pagination-small"><ul id="milestone_pagination" ></ul></div>
  </div>

  
  <!-- Add Project Modal -->
  <div id="addProjectModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Add Project</h3>
    </div>
    <form id="addproject_form" action="#" method="post" class="form-horizontal" onsubmit="project_add();return false;">
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label" for="addProject_title">Project Name</label>
          <div class="controls">
            <input required id="addProject_title" type="text" placeholder="My fabulous project"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="addProject_desc">Description</label>
          <div class="controls">
            <textarea required id="addProject_desc" class="input-xlarge" rows="5" placeholder="Creating a laser guided, solar powered, sub-atomic squid army."></textarea>
            </p>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="addProject_start">Start date</label>
          <div class="controls">
            <input required type="text" id="addProject_start" placeholder="YYYY-MM-DD" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="addProject_due">Due date</label>
          <div class="controls">
            <input required type="text" id="addProject_due" placeholder="YYYY-MM-DD" />
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button type="submit" id="addProject_submit" class="btn btn-primary"><i class="icon-plus icon-white"></i> Project</button> <img src="images/spinner.gif" id="addProject_spinner" class="hide" />
      </div>
    </form>
  </div>

  <!-- edit milestone -->
  <div id="editProjectModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Edit Project</h3>
    </div>
    <form id="editproject_form" action="#" method="post" class="form-horizontal" onsubmit="project_edit();return false;">
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label" for="editproject_title">Project Name</label>
          <div class="controls">
            <input required id="editproject_title" type="text" placeholder="My fabulous project"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="editproject_desc">Description</label>
          <div class="controls">
            <textarea required id="editproject_desc" class="input-xlarge" rows="5" placeholder="Creating a laser guided, solar powered, sub-atomic squid army."></textarea>
            </p>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="editproject_start">Start date</label>
          <div class="controls">
            <input required type="text" id="editproject_start" placeholder="YYYY-MM-DD" />
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="editproject_due">Due date</label>
          <div class="controls">
            <input required type="text" id="editproject_due" placeholder="YYYY-MM-DD" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
         <button class="btn btn-link pull-left" onclick="project_delete();return false;" aria-hidden="true">Delete</button>
         <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button type="submit" id="editprosject_submit" class="btn btn-primary">Update Project</button> <img src="images/spinner.gif" id="editProject_spinner" class="hide" />
      </div>
    </form>
  </div>

  <!-- add Milestone -->
  <div id="addMilestoneModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="addMilestoneModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Add Milestone</h3>
    </div>
    <form id="addmilestone_form" action="#" method="post" class="form-horizontal" onsubmit="milestone_add();return false;">
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label" for="addmilestone_title">Milestone</label>
          <div class="controls">
            <input required id="addmilestone_title" type="text" placeholder="Take photos of kittens"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="addmilestone_desc">Additional Info (optional)</label>
          <div class="controls">
            <textarea id="addmilestone_desc" class="input-xlarge" rows="5" placeholder="Remember to use the nice kittens, not the horrible ones."></textarea>
            </p>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="addmilestone_due">Due date</label>
          <div class="controls">
            <input required type="text" id="addmilestone_due" placeholder="YYYY-MM-DD" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button type="submit" id="addmilestone_submit" class="btn btn-primary"><i class="icon-plus icon-white"></i> Milestone</button> <img src="images/spinner.gif" id="addmilestone_spinner" class="hide" />
      </div>
    </form>
  </div>
  <div id="editMilestoneModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editMilestoneModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Edit Milestone</h3>
    </div>
    <form id="editmilestone_form" action="#" method="post" class="form-horizontal" onsubmit="milestone_edit();return false;">
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label" for="editmilestone_title">Milestone</label>
          <div class="controls">
            <input required id="editmilestone_title" type="text" placeholder="Take photos of kittens"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="editmilestone_desc">Additional Info (optional)</label>
          <div class="controls">
            <textarea id="editmilestone_desc" class="input-xlarge" rows="5" placeholder="Remember to use the nice kittens, not the horrible ones."></textarea>
            </p>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="editmilestone_due">Due date</label>
          <div class="controls">
            <input required type="text" id="editmilestone_due" placeholder="YYYY-MM-DD" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button type="submit" id="editmilestone_submit" class="btn btn-primary">Edit Milestone</button> <img src="images/spinner.gif" id="editmilestone_spinner" class="hide" />
      </div>
    </form>
  </div>
</div>
<script type="text/javascript"  src="js/dashboard.js"></script> 
