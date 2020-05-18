<?php

$email_to = "poojasingh2866@gmail.com";


$admissions_page = "admissions.html";
$thanks_page = "thankyou.html";


$name = $_REQUEST['name'] ;
$email = $_REQUEST['email'] ;
$number = $_REQUEST['number'];
$qualification = $_REQUEST['qualification'];
$branch = $_REQUEST['branch'] ;

$msg = 
"Name: " . $name . "\r\n" . 
"Email: " . $email . "\r\n" . 
"Mobile No: ".$number. "\r\n".
"Qualification: ".$qualification. "\r\n".
"branch: " . $branch ;


function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}


if (!isset($_REQUEST['email'])) {
header( "Location: $admissions_page" );
}


elseif (empty($name) || empty($email)) {
header( "Location: $admissions_page" );
}


elseif ( isInjected($email) || isInjected($name)  || isInjected($branch) || isInjected($number) || isInjected($qualification) ) {
header( "Location: $admissions_page" );

}


else {

	mail( "$email_to", "Contact Form Results", $msg );
	header("Location: $thanks_page");
		
}
    
?>