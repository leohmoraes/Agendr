<?php
/* 
 * (c) Agendr.eu 2013 
 * Database library class for PDO wrapper. Defaults to mysql.
 */
class Database
{
	public $link;
	
	//on create build a link to the database
	public function __construct($d,$s,$u,$p){
		try{
		$this->link=new PDO("mysql:host=".$s.";dbname=".$d,$u,$p);
		} catch(PDOException $e) {
			print("There's a problem connecting to the server... See error logs.");
		}
	}

	/* 	insert a set of objects into a table
	 	$table = String
	 	$object array of key=>value pairs */
	public function insertQuery($table,$object){
		$keys=$pkeys=$values="";
		$input=array();
		foreach($object as $k=>$v){
			$keys.=$k.",";
			$pkeys.=":".$k.",";
			$input[$k]=$v;
		}
		
		$keys=rtrim($keys,",");
		$pkeys=rtrim($pkeys,",");
		
		$sql="INSERT INTO ".$table." ({$keys}) VALUES ({$pkeys})";

		try{
			$this->link->beginTransaction();
			$q=$this->link->prepare($sql) or die("Whoops");;
			$q->execute($object);
			$this->link->commit();
			return true;
		} catch(PDOException $e) {
			return false;
		}
		

	}
	
	/* 	fetch a row we only expect a single return from
		$table = Table in db
		$object = Associative array for clauses
		$values = comma seperated list of values to return, or * for all
		return true on yes, false on no. */

	public function fetchRow($table,$object,$values){
			$clause="";
			foreach($object as $k=>$v)
			{
				$clause.=$k."=:".$k." AND ";
			}
			$clause=substr($clause,0,-5);
			
			$sql="SELECT $values FROM $table WHERE ".$clause;
			
			try{
				$stmt=$this->link->prepare($sql) or die("Whoops");;
				$stmt->execute($object);
				return $stmt->fetch(PDO::FETCH_ASSOC);
			} catch(PDOException $e) {
				print_r($e);
			}
			
			
	}
	/* 	fetch an associative array of multiple rows
		
		$table = Table in db
		$object = Associative array for clauses
		$values = comma seperated list of values to return, or * for all
		$limit = number to retrieve
		$order = SQL statement of ordering
		$join_table = another table to join on 
		$join_column = column in both databases to join on

		return true on yes, false on no. */
	public function fetchRows($table,$object,$values="*",$start=0,$limit=NULL,$order=NULL,$join_table=NULL,$join_column=NULL){
			$clause="";
			foreach($object as $k=>$v)
			{
				$clause.=$table.".".$k."=:".$k." AND ";
			}
			$clause=substr($clause,0,-5);
			
			$sql="SELECT $values FROM $table ";

			if($join_table)
			{
				$sql.="JOIN $join_table ON {$table}.{$join_column}={$join_table}.{$join_column} ";
			}

			$sql.="WHERE ".$clause;
			

				
			if($order)
				$sql.=" ORDER BY ".$order;
			if($limit)
				$sql.=" LIMIT ".$start.",".$limit;
			
			try{
				$stmt=$this->link->prepare($sql) or die("Whoops");;
					
					$stmt->execute($object);

				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch(PDOException $e) {
				print_r($e);
			}
			
			
	}

	/* 	Update a row
	
	$table = Table in db
	$setvalues = Associative array for values to change
	$object = Associative array for WHERE clause

	return true on yes, false on no. */
	public function updateQuery($table,$setvalues,$object){
			$where="";
			foreach($object as $k=>$v)
			{
				$where.=$k."=:".$k." AND ";
			}
			$where=substr($where,0,-5);
			
			$values="";
			foreach($setvalues as $k=>$v)
			{
				$values.=$k."=:".$k.",";
			}
			$values=substr($values,0,-1);
			
			$sql="UPDATE $table SET $values WHERE ".$where;
			error_log($sql);
			
			try{
				$stmt=$this->link->prepare($sql) or die($sql);
			} catch(PDOException $e) {
				print_r($e);
			}
			try{
				return $stmt->execute(array_merge($object,$setvalues)) or die($sql);	
			} catch(PDOException $e) {
				print_r($e);
			}
			
			
	}

	/* 	delete a row or number of rows
	
	$table = Table in db
	$object = Associative array for WHERE clause

	return true on yes, false on no. */
	public function deleteQuery($table,$object){
			$where="";
			foreach($object as $k=>$v)
			{
				$where.=$k."=:".$k." AND ";
			}
			$where=substr($where,0,-5);
							
			$sql="DELETE FROM $table WHERE ".$where;
			error_log($sql);
			
			try{
				$stmt=$this->link->prepare($sql) or die($sql);
			} catch(PDOException $e) {
				print_r($e);
			}
			try{
				return $stmt->execute($object) or die($sql);	
			} catch(PDOException $e) {
				print_r($e);
			}
			
			
	}
}
