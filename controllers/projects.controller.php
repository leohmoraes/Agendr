<?php

class ProjectsController{

	private $db;

	static function fix_tags(&$item,$key){
		$item=strip_tags($item);
	}

	public function __construct(){
		global $db_db,$db_server,$db_user,$db_pass;
		$this->db=new Database($db_db,$db_server,$db_user,$db_pass);	
	}

	public function getDashProjects($num){
		$uid=$_SESSION['loggedin'];
		
		$projobj=array('user_id'=>$uid,"project_done"=>0);
		return $this->db->fetchRows("what_projects",$projobj,"project_id,project_title,project_desc,project_due,project_start",0,$num,"project_due ASC");

	}

	public function getProject($id){
		$uid=$_SESSION['loggedin'];
		
		$projobj=array('user_id'=>$uid,'project_id'=>$id);
		
		return $this->db->fetchRow("what_projects",$projobj,"*");
	}

	public function getProjects($start,$num){
		$uid=$_SESSION['loggedin'];
		
		$projobj=array('user_id'=>$uid);
		
		return $this->db->fetchRows("what_projects",$projobj,"project_id,project_title,project_due,project_desc,project_start,project_done",$start,$num,"project_due ASC");
	}	
	
	public function getNumProjects($done=0){
		$uid=$_SESSION['loggedin'];
		
		$projobj=array('user_id'=>$uid,'project_done'=>$done);
		
		return $this->db->fetchRow("what_projects",$projobj,"COUNT(project_id) AS project_count");
	}

	public function getMilestones($proj){
		$uid=$_SESSION['loggedin'];
		
		$projobj=array('user_id'=>$uid,'project_id'=>$proj);
		
		return $this->db->fetchRows("what_milestones",$projobj,"milestone_id,milestone_id,milestone_title,what_milestones.project_id,milestone_due,project_title,milestone_done",0,NULL,"milestone_due ASC","what_projects","project_id");
	}

	public function getNumMilestones($proj=NULL,$archived=NULL,$done=NULL){
		$uid=$_SESSION['loggedin'];
		
		$projobj=array('user_id'=>$uid);
		
		if($proj)
			$projobj['project_id']=$proj;

		if(isset($archived))
			$projobj['milestone_archived']=$archived;
		if(isset($done))
			$projobj['milestone_done']=$done;
		
		return $this->db->fetchRow("what_milestones",$projobj,"COUNT(milestone_id) AS milestone_total");
	}

	
	public function getMilestone($id){
		$uid=$_SESSION['loggedin'];
		
		$projobj=array('user_id'=>$uid,'milestone_id'=>$id);
		
		return $this->db->fetchRow("what_milestones",$projobj,"*");
	}

	public function getDashMilestones($start,$limit){
		$uid=$_SESSION['loggedin'];
		
		$projobj=array('user_id'=>$uid,'milestone_archived'=>0,'milestone_done'=>0);
		return $this->db->fetchRows("what_milestones",$projobj,"milestone_id,milestone_id,milestone_title,milestone_desc,what_milestones.project_id,milestone_due,project_title",$start,$limit,"milestone_due ASC","what_projects","project_id");

	}

	public function addProject($object){
		array_walk($object,"ProjectsController::fix_tags");

		$projobj['project_done']=0;
		$projobj['user_id']=$_SESSION['loggedin'];
		$num=$this->db->fetchRow('what_projects',$projobj,"COUNT(project_id) AS project_total");

		$num=$num['project_total'];

		if($num<$_SESSION['maxprojects'])
			return $this->db->insertQuery("what_projects",$object);
		else
			return array("debug"=>"num: ".$num." | max: ".$_SESSION['maxprojects'],"status"=>"Too many projects. You may wish to archive some or upgrade to a different package.");
		
	}

	public function addMilestone($object){
		array_walk($object,"ProjectsController::fix_tags");
		return $this->db->insertQuery("what_milestones",$object);
	}

	public function updateProject($proj_id,$object){
		$variables=array(
			"user_id"=>$_SESSION['loggedin'],
			"project_id"=>$proj_id
		);
		array_walk($object,"ProjectsController::fix_tags");
		return $this->db->updateQuery("what_projects",$object,$variables);
	}

	public function updateMilestone($id,$object){
		$variables=array(
			"user_id"=>$_SESSION['loggedin'],
			"milestone_id"=>$id
		);
		array_walk($object,"ProjectsController::fix_tags");
		return $this->db->updateQuery("what_milestones",$object,$variables);
	}

	public function updateProjectMilestones($proj_id,$object){
		$variables=array(
			"user_id"=>$_SESSION['loggedin'],
			"project_id"=>$proj_id
		);
		array_walk($object,"ProjectsController::fix_tags");
		return $this->db->updateQuery("what_milestones",$object,$variables);

	}	
	public function deleteProject($proj_id){
		$variables=array(
			"user_id"=>$_SESSION['loggedin'],
			"project_id"=>$proj_id
		);

		$object=array("project_archive"=>"1");

		$projectsok=$this->db->deleteQuery("what_projects",$variables);
		$milestonesok=$this->db->deleteQuery("what_milestones",$variables);

		return $projectsok&$milestonesok;

	}
	public function deleteMilestone($proj_id){
		$variables=array(
			"user_id"=>$_SESSION['loggedin'],
			"milestone_id"=>$proj_id
		);

		$milestonesok=$this->db->deleteQuery("what_milestones",$variables);

		return $projectsok&$milestonesok;

	}

	
	 
}

?>