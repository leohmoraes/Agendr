/* 
(c) Agendr.eu 2013 
Javascript for dashboard.view.php
*/
	$(document).ready(function(){
      $("#addProject_form").validate();
      $("#editproject_form").validate();
      $("#addmilestone_form").validate();
      $("#editmilestone_form").validate();      
      getDashProjects();     
      arr_projects=new Array();

      //constants
      max_show=10;

		});


		// set up date pickers
		$(function() {
      $( "#addProject_due" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#addProject_start" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#editproject_due" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#editproject_start" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#addmilestone_due" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#editmilestone_due" ).datepicker({ dateFormat: 'yy-mm-dd' });
		});
		
    /*  ***** projects AJAX ****** */
    var project_fetch=function(id){
      //console.log("project_fetch")
      $.post(
        "ajax.php?project",
        {
          action: "fetch",
          id: id
        },
        function(data){
            $("#editproject_title").val(data.project_title);
            $("#editproject_desc").val(data.project_desc);
            $("#editproject_due").val(data.project_due);
            $("#editproject_start").val(data.project_start);
            $("#editproject_spiner").hide();
        }
        ,"json"
      );

    }

    var project_add=function(){
      $("#addProject_spinner").show();
      //console.log("project_add")
      $.post(
        "ajax.php?project",
        {
          action: "add",
          title: $("#addProject_title").val(),
          desc: $("#addProject_desc").val(),
          due: $("#addProject_due").val(),
          start: $("#addProject_start").val()
        },
        function(data){

          if(data["status"]==null)
          {
            $("#addProject_title").val("");
            $("#addProject_desc").val("");
            $("#addProject_due").val("");
            $("#addProject_start").val("");
            $("#addProject_spinner").hide();
            $("#addProjectModal").modal("hide");
            getDashProjects();
          }
          else
          {
            $("#project_alert").show();
            $("#project_alert").text(data["status"]);
            $("#addProject_spinner").hide();
            $("#addProjectModal").modal("hide");
          }
        }
        ,"json"
      );
    }
    var project_delete=function(){
      //console.log("project_delete")

      $.post(
        "ajax.php?project",
        {
          action: "delete",
          id: current_project
        },
        function(data){
            $("#editProjectModal").modal("hide");
            getDashProjects();
            
        }
        ,"json"
      );
    }
    var project_edit=function(){
      //console.log("project_edit")

      $("#addProject_spinner").show();
      $.post(
        "ajax.php?project",
        {
          action: "update",
          title: $("#editproject_title").val(),
          desc: $("#editproject_desc").val(),
          due: $("#editproject_due").val(),
          start: $("#editproject_start").val(),
          id: current_project
        },
        function(data){
            $("#editproject_title").val("");
            $("#editproject_desc").val("");
            $("#editproject_due").val("");
            $("#editproject_start").val(""),
            $("#editproject_spinner").hide();

            $("#editProjectModal").modal("hide");
            getDashProjects();

        }
        ,"json"
      );
    }

    var project_archive=function(p){
      $.post(
        "ajax.php?project",
        {
          action: "archive",
          archive: 1,
          id: p
        },function(data){

          getDashProjects();

        }
        ,"json"
      );
    }

    var getDashProjects=function(){
      //console.log("getDashProjects")
      $("#project_spinner").show();
      $.post(
        "ajax.php?project",
        {
          action: "dash",
          num: "10"
        },
        function(data){
            now=new Date();
            $('#projectList').html("");

            project_total=data['project_total'];
            project_max=data['project_max'];
            delete data['project_total'];
            delete data['project_max'];
            if(project_total==project_max)
            {
                $("#addProject_button").hide();

                $("#project_alert").show();
                $("#project_alert").text("You've reached your project maximum. You will not be able to add any more until you upgrade your package or archive some older ones.");
            }
            else
            {
               $("#addProject_button").show();
               $("#project_alert").hide();
            }

            $("#project_number").text("("+project_total+"/"+project_max+")");

            
            for(x in data)
            {
           
              d=new Date(data[x].project_due.replace(/-/g, "/"));
              sd=new Date(data[x].project_start.replace(/-/g, "/"));
              datediff=new Date(d-now);
              datediff=Math.ceil(datediff/86400000);
              if(datediff<0)
                  datestr="<span class='label label-important'>-"+(-datediff)+" day";
              else if(datediff==0)
                  datestr="<span class='label label-warning'>Today";
              else
                  datestr="<span class='label label-success'>"+datediff+" day"
              //console.log(Math.abs(datediff));
              if(Math.abs(datediff)!=1 && datediff!=0)
                  datestr+="s";
              datestr+="</span>"


              sdatediff=new Date(sd-now);
              sdatediff=Math.ceil(sdatediff/86400000);
              sdatestr=Math.abs(sdatediff);
              if(Math.abs(sdatediff)!=1 && sdatediff!=0)
                  sdatepost="s";
              else
                  sdatepost="";
              if(sdatediff<0)
                  sdatestr+=" day"+sdatepost+" ago";
              else if(datediff==0)
                  sdatestr="Today";
              else
                  sdatestr+=" day"+sdatepost;
              //console.log(Math.abs(datediff));
            
              

              arr_projects[data[x].project_id]=data[x];
              
              $('#projectList').append(
                   "<tr id='projectrow_"+data[x].project_id+"''>"
                  +"<td class='highlight"+((data[x].project_id%8)+1)+"'>"
                    +"<div class='project-title'>"+data[x].project_title+"</div>"
                    +"<div class='project-desc'>"+data[x].project_desc+"</div>"
                  +"</td>"
                  +"<td>"+sdatestr+"</td>"
                  +"<td>"+datestr+"</td>"
                  
                  +"<td class='text-right nowrap'>"
                  +"<span class='dropdown pull-right'>"
                    +"<a onclick='showMilestoneModal(this)' data-projectid="+data[x].project_id+" href='#' class='btn btn-mini btn-primary'><i class='icon-plus icon-white'></i> Milestone</a> "
                    +"<a class='dropdown-toggle btn btn-info btn-mini' data-toggle='dropdown' href='#'><i class='icon-reorder'></i></a>"
                    +"<ul class='dropdown-menu' role='menu'>"
                          +"<li><a data-projectid="+data[x].project_id+" onclick='showEditProjectModal(this)' href='#'>Edit</a></li>"
                          +"<li><a href='#' onclick='project_archive("+data[x].project_id+");'>Archive</a></li>"
                        
                    +"<ul>"
                  +"</span>"
                  +"</td>"
                  +"</tr>"


                  );  
            }
            
            $("#project_spinner").fadeOut();

            if(project_total>0)
            {

              getDashMilestones();
            }
            else
            {
              $("#milestone_spinner").fadeOut();
              $("#alert_noprojects").fadeIn();
            }
          }
        ,"json"
      );      
    }

    var showEditProjectModal=function(e){
       //console.log("showEditProjectModal");
        current_project=$(e).attr("data-projectid");
        project_fetch(current_project);
        $("#editProjectModal").modal('show');
    }


    /*  ***** milestones ****** */
    var milestone_add=function(){
      //console.log("milestone_add");
      $("#addmilestone_spinner").show();
      $.post(
        "ajax.php?milestone",
        {
          action: "add",
          title: $("#addmilestone_title").val(),
          desc: $("#addmilestone_desc").val(),
          due: $("#addmilestone_due").val(),
          project: current_milestone
        },
        function(data){
            $("#addmilestone_title").val("");
            $("#addmilestone_desc").val("");
            $("#addmilestone_due").val("");
            $("#addmilestone_spinner").hide();
            $("#addMilestoneModal").modal("hide");
            getDashMilestones();
        }
        ,"json"
      );
    }

    var milestone_complete=function(p){
     // console.log("milestone_complete");
      $.post(
        "ajax.php?milestone",
        {
          action: "complete",
          archive: 1,
          id: p
        },function(data){

          getDashProjects();

        }
        ,"json"
      );
    }

    var milestone_edit=function(){
      //      console.log("milestone_edit")

      $("#editmilestone_spinner").show();
      $.post(
        "ajax.php?milestone",
        {
          action: "update",
          title: $("#editmilestone_title").val(),
          desc: $("#editmilestone_desc").val(),
          due: $("#editmilestone_due").val(),
          project_id: current_project,
          milestone_id: current_milestone

        },
        function(data){
            $("#editmilestone_title").val("");
            $("#editmilestone_desc").val("");
            $("#editmilestone_due").val("");
            $("#editmilestone_spinner").hide();

            $("#editMilestoneModal").modal("hide");
            getDashProjects();

        }
        ,"json"
      );
    }


    /*  ***** projects AJAX ****** */
    var milestone_fetch=function(id){
      //console.log("milestone_fetch")
      $.post(
        "ajax.php?milestone",
        {
          action: "fetch",
          id: id
        },
        function(data){
            $("#editmilestone_title").val(data.milestone_title);
            $("#editmilestone_desc").val(data.milestone_desc);
            $("#editmilestone_due").val(data.milestone_due);
            $("#editproject_spiner").hide();
        }
        ,"json"
      );

    }


    var getDashMilestones=function(page){
      //console.log("getDashMilestones");
      
      if(page==null)
          page=0;
      start=page*max_show;
      show=start+max_show;
      milestone_page=page;

      $("#project_spinner").hide();
      $("#milestone_spinner").show();
      $.post(
        "ajax.php?milestone",
        {
          action: "dash",
          num: show,
          start: start
        },
        function(data){

            now=new Date();

             milestone_total=data['milestone_total'];
            delete data['milestone_total'];
           
            $('#milestoneList').html("");
            for(x in data)
            {
              
              d=new Date(data[x].milestone_due.replace(/-/g, "/"));
              datediff=new Date(d-now);
              datediff=Math.ceil(datediff/86400000);
              if(datediff<0)
                  datestr="<span class='label label-important'>-"+(-datediff)+" day";
              else if(datediff==0)
                  datestr="<span class='label label-warning'>Today";
              else
                  datestr="<span class='label label-success'>"+datediff+" day"
              //console.log(Math.abs(datediff));
              if(Math.abs(datediff)!=1 && datediff!=0)
                  datestr+="s";
              datestr+="</span>";
             

              $('#milestoneList').append(
                  "<tr>"
                  +"<td class='milestone-project highlight"+((data[x].project_id%8)+1)+"'>"+data[x].project_title+"</td>"
                  +"<td class='milestone-title'><div>"+data[x].milestone_title+"</div>"
                    +"<div class='milestone-desc'>"+data[x].milestone_desc+"</div>"

                  +"</td>"

                  +"<td>"+datestr+"</td>"
                  +"<td class='text-right nowrap'>"
                  +"<span class='dropdown pull-right'>"
                    +"<a class='dropdown-toggle btn btn-info btn-mini' data-toggle='dropdown' href='#'><i class='icon-reorder'></i></a>"
                    +"<ul class='dropdown-menu' role='menu'>"
                          +"<li><a data-projectid="+data[x].project_id+" data-milestoneid="+data[x].milestone_id+" onclick='showEditMilestoneModal(this)' href='#'>Edit</a></li>"
                          +"<li><a href='#' onclick='milestone_complete("+data[x].milestone_id+");'>Complete</a></li>"
                      
                    +"<ul>"
                  +"</span>"
                  +"</td>"
                  +"</tr>"
 
              );  
            }
            $("#milestone_spinner").fadeOut();
            $("#milestone_pagination").empty();
            milestone_pages=Math.ceil(milestone_total/max_show);
            for(i=0;i<milestone_pages;i++){
              if(i==milestone_page)
                active="active";
              else
                active="";
              $("#milestone_pagination").append(
                "<li class="+active+"><a href='#' onclick='getDashMilestones("+i+")'>"+(i+1)+"</li>"
              );
            } 
        }
        ,"json"
      );      
    }

    var showEditMilestoneModal=function(e){
        //console.log("showEditMilestoneModal");
        current_milestone=$(e).attr("data-milestoneid");
        current_project=$(e).attr("data-projectid");
        milestone_fetch(current_milestone);
        $("#editMilestoneModal").modal('show');
    }


    var showMilestoneModal=function(e){
      //console.log("showMilestoneModal");
        current_milestone=$(e).attr("data-projectid");
        $("#addMilestoneModal").modal('show');
    }
