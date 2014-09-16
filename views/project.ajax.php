<?php
	include("controllers/projects.controller.php");
	
	$pc=new ProjectsController();
	
	$json=array();
	
	switch($_POST['action'])
	{
		//we're adding a project 
		case "add":
			$postObj=array(
				"project_title"=>$_POST['title'],
				"project_desc"=>$_POST['desc'],
				"project_due"=>$_POST['due'],
				"project_start"=>$_POST['start'],
				"user_id"=>$_SESSION['loggedin']

			);
			$ret=$pc->addProject($postObj);
			$json['status']=$ret['status'];
			break;

		//we're fetching projects for the dashboard
		case "dash":
			$json=$pc->getDashProjects($_POST['num']);
			//$json['project_count']=count($json);
			$num=$pc->getNumProjects();

			$json['project_total']=$num['project_count'];
			$json['project_max']=$_SESSION['maxprojects'];
			break;

		case "archived":
			$json=$pc->getProjects($_POST['start'],$_POST['num']);
			break;

		//we're fetching an entire project
		case "fetch":
			$json=$pc->getProject($_POST['id']);
			break;
		case "update":
			$postObj=array(
				"project_title"=>$_POST['title'],
				"project_desc"=>$_POST['desc'],
				"project_due"=>$_POST['due'],
				"project_start"=>$_POST['start'],
			);
			$json["status"]=$pc->updateProject($_POST['id'],$postObj);
			break;
		case "archive":
			$postObj=array(
				"project_done"=>$_POST['archive']
			);
			$json["status"]=$pc->updateProject($_POST['id'],$postObj);
			$postObj=array(
				"milestone_archived"=>$_POST['archive']
			);			
			$json["status"]=$pc->updateProjectMilestones($_POST['id'],$postObj);

			break;
		case "delete":
			$json["status"]=$pc->deleteProject($_POST['id']);
			break;

		//return an error
		default:
			$json['status']="You fell through all the actions and reached the bottom.";
	}
	echo json_encode($json);
?>