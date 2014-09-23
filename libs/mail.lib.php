<?php
/*
	(c) agendr.eu 2014
	Mail class.

*/
class Mailer{

	/* 	send a mail from a text template
		
		$template - location of text template on disk
		$to - recipient address
		$subject - subject of email
		$objects - objects in assoc array to replace in template 

	*/
	public function sendTemplateMail($template,$to,$subject,$objects){
		$f=fopen($template,"r");
		$in=fread($f,filesize($template));
		
		foreach($objects as $k=>$v)
		{
			$in=str_replace("{".$k."}","{$v}",$in);	
		}
		error_log($in);
		$headers =  'From: hostmaster@agendr.eu' . "\r\n" .
    				'Reply-To: hostmaster@agendr.eu' . "\r\n" .
    				'Return-Path:<hostmaster@agendr.eu>' . "\r\n".
    				'X-Mailer: PHP/' . phpversion();

    	$optionalparams = '-r'."hostmaster@agendr.eu";

		mail($to,$subject,$in,$headers,$optionalparams);
		
	}
}
