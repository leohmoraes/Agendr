<?php
	include("controllers/projects.controller.php");
	
	$pc=new ProjectsController();
	
	$json=array();
	
	switch($_POST['action'])
	{
		//we're adding a project 
		case "add":
			$postObj=array(
				"milestone_title"=>$_POST['title'],
				"milestone_desc"=>$_POST['desc'],
				"milestone_due"=>$_POST['due'],
				"project_id"=>$_POST['project'],
				"user_id"=>$_SESSION['loggedin']

			);
			$pc->addMilestone($postObj);
			$json['status']="ok";
			break;

		//we're fetching projects for the dashboard
		case "dash":
			$json=$pc->getDashMilestones($_POST['start'],$_POST['num']);
			//$json['project_count']=count($json);
			$num=$pc->getNumMilestones(NULL,MILESTONE_NOT_ARCHIVED,MILESTONE_NOT_DONE);

			$json['milestone_total']=$num['milestone_total'];
			break;
		case "fetchall":
			$json=$pc->getMilestones($_POST['project_id']);
			break;
		case "fetch":
			$json=$pc->getMilestone($_POST['id']);
			break;
		case "update":
			$postObj=array(
				"milestone_title"=>$_POST['title'],
				"milestone_desc"=>$_POST['desc'],
				"milestone_due"=>$_POST['due'],
			);
			$json["status"]=$pc->updateMilestone($_POST['milestone_id'],$postObj);
			break;
		case "archive":
			$postObj=array(
				"milestone_archive"=>$_POST['archive']
			);
		case "complete":
			$postObj=array(
				"milestone_done"=>$_POST['archive']
			);
			$json["status"]=$pc->updateMilestone($_POST['id'],$postObj);
			break;
		case "delete":
			$json["status"]=$pc->deleteMilestone($_POST['id']);
			break;


		//return an error
		default:
			$json['status']="error";
	}
	echo json_encode($json);
?>