/* 
(c) Agendr.eu 2013 
Javascript for archive.view.php
*/


	$(document).ready(function(){
			$("#addproject_form").validate();
      getArchiveProjects();     
      arr_projects=new Array();
		});


    var project_delete=function(id){
            //console.log("project_delete")

      $.post(
        "ajax.php?project",
        {
          action: "delete",
          id: id
        },
        function(data){
            $("#editProjectModal").modal("hide");
            getArchiveProjects();
            
        }
        ,"json"
      );
    }

    var project_unarchive=function(p){
      $.post(
        "ajax.php?project",
        {
          action: "archive",
          archive: 0,
          id: p
        },function(data){

          getArchiveProjects();

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

          getArchiveProjects();

        }
        ,"json"
      );
    }

    var getArchiveProjects=function(){
      //console.log("getArchiveProjects")

      $.post(
        "ajax.php?project",
        {
          action: "archived",
          num: "10",
          start: "0"
        },
        function(data){
            now=new Date();
            $('#projectList').html("");
            for(x in data)
            {
              d=new Date(data[x].project_due.replace(/-/g, "/"));
              sd=new Date(data[x].project_start.replace(/-/g, "/"));

              datediff=new Date(d-now);
              datediff=Math.ceil(datediff/86400000);
              if(datediff<0)
                  datestr="<span class='label label-important'>Overdue "+(-datediff)+" day";
              else if(datediff==0)
                  datestr="<span class='label label-warning'>Today";
              else
                  datestr="<span class='label label-success'>"+datediff+" day"
              console.log(Math.abs(datediff));
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


              if(data[x].project_done==1){
                  archive_unarchive="<li><a href='#' onclick='project_unarchive("+data[x].project_id+");'>Unarchive</a></li>";       
                  label="<span class='label label-info'>Archived</span>";
              }
              else {
                  archive_unarchive="<li><a href='#' onclick='project_archive("+data[x].project_id+");'>Archive</a></li>";
                  label="<span class='label label-success'>Live</span>";
              }

              arr_projects[data[x].project_id]=data[x];


              
              $('#projectList').append(
                   "<tr id='projectrow_"+data[x].project_id+"''>"
                  +"<td class='highlight"+((data[x].project_id%8)+1)+"'>"
                    +"<div class='project-title'>"+data[x].project_title+"</div>"
                    +"<div class='project-desc'>"+data[x].project_desc+"</div>"
                  +"</td>"
                  +"<td class='nowrap'>"+data[x].project_start+"</td>"
                  +"<td class='nowrap'>"+datestr+"</td>"
                  +"<td class='nowrap'>"+label+"</td>"                  
                  +"<td class='text-right nowrap'>"
                  +"<span class='dropdown pull-right'>"
                    +"<a onclick='getArchiveMilestones("+data[x].project_id+")' href='#' class='btn btn-mini btn-primary'><i class='icon-search icon-white'></i> Milestones</a> "
                    +"<a class='dropdown-toggle btn btn-info btn-mini' data-toggle='dropdown' href='#'><i class='icon-reorder'></i></a>"
                    +"<ul class='dropdown-menu' role='menu'>"
                          +"<li>"+archive_unarchive+"</li>"
                          
                          //+"<li><a href='#' onclick='project_delete("+data[x].project_id+");'>Delete</a></li>"
                        
                    +"<ul>"
                  +"</span>"
                  +"</td>"
                  +"</tr>");  
            }
           
        }
        ,"json"
      );      
    }

    var getArchiveMilestones=function(project){
      //console.log("getArchiveMilestones");
      $.post(
        "ajax.php?milestone",
        {
          action: "fetchall",
          project_id: project
        },
        function(data){

            now=new Date();

            
            $('#milestoneList').html("");
            for(x in data)
            {
              
              d=new Date(data[x].milestone_due.replace(/-/g, "/"));
              datediff=new Date(d-now);
              datediff=Math.ceil(datediff/86400000);
              if(datediff<0)
                  datestr="<span class='label label-important'>Overdue "+(-datediff)+" day";
              else if(datediff==0)
                  datestr="<span class='label label-warning'>Today";
              else
                  datestr="<span class='label label-success'>"+datediff+" day"
              //console.log(Math.abs(datediff));
              if(Math.abs(datediff)!=1 && datediff!=0)
                  datestr+="s";
              datestr+="</span>"
              if(data[x].milestone_done==1)
                  label="Done";
              else
                  label="";
              $('#milestoneList').append(
                  "<tr>"
                  +"<td><div>"+data[x].milestone_title+"</div><div class='hide milestone-project'>&#9492; "+data[x].project_title+"</div></td>"
                  +"<td class='nowrap'>"+datestr+"</td>"
                  +"<td><span class='label label-success'>"+label+"</td>"
                  +"</tr>"
 
              );  
            }
        }
        ,"json"
      );      
    }

