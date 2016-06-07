<?php 
require_once '../includes/class.Staff.php';
require_once '../../includes/validate_required_fields.php';

// set content to HTML, class.Person.php requires ini file
//header('Content-Type: text/html');

session_start();

$requiredStringFields = array('email', 'status');
$requiredArrayFields = array('name'=>array('first_name', 'last_name')); 
$valid = true;
$staff = new Staff();
$errorMsg = array();
$_SESSION['error_msg'] = '';

// validate that id is valid mongoid
if(!$staff->validate_mongo_id($_POST['id'])){
	die('There was an error retrieving that page, invalid ID, please try again! <br/><a href="../index.php">Go Back!</a>');
}

// foreach item on post, save to a variable data on session so you can pass back to other page
foreach($_POST as $k=>$v){
	$_SESSION['post_data'][$k] = $v;	
}

$validFields = $staff->validatePostFields($_POST);

if(!$validFields['valid']){
	$valid = false;
	foreach($validFields['error'] as $error){
		array_push($errorMsg, $error);
	}
}

// trim and escape all input
foreach($_POST as $k=>$v){
	
	if(empty($v)){
		break;	
	}
	
	// If $_POST[key] is an array, loop through the array and trim whitespace and remove html tags from fields
	if(is_array($_POST[$k])){
		
		foreach($v as $innerKey=>$innerValue){
			$_POST[$k][$innerKey] = htmlspecialchars(trim($innerValue));
		}
		
	// trim whitespace and remove html tags from fields
	} else {
		
		$_POST[$k] = htmlspecialchars(trim($v));
	}
}

if(!$valid){
	$_SESSION['error_msg'] = $errorMsg;
	
	die(header('Location: ../pages/edit.php?id='.$_POST['id']));
}

// built correctly formatted array for saving record to db
$newRecord = $staff->build_staff_record_array($_POST);

// Add new record to db
$resp = $staff->update($_POST['id'], array('$set'=>$newRecord));

header('Location: ../index.php');

?>
