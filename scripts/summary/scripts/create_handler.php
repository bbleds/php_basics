<?php 
require_once '../../ini.php';
require_once '../includes/class.Staff.php';
require_once '../../includes/validate_required_fields.php';
require_once '../../tt4lib/src/class.Util.php';


session_start();

$requiredStringFields = array('email', 'status');
$requiredArrayFields = array('name'=>array('first_name', 'last_name')); 
$valid = true;
$staff = new Staff();
$errorMsg = array();
$_SESSION['error_msg'] = '';

// foreach item on post, save to a variable data on session so you can pass back to other page
foreach($_POST as $k=>$v){
	$_SESSION['post_data'][$k] = $v;	
}



// validate that $requiredStringFields exist in $_POST
foreach($requiredStringFields as $field){	
	// be sure field is not empty and isset
	if(empty($_POST[$field]) || !isset($_POST[$field])){
		$valid = false;	
		array_push($errorMsg, 'Make sure that you entered an email and selected a status!');
		break;
	}
}

// validate that fields within $requiredArrayFields exist in $_POST
foreach($requiredArrayFields as $k=>$fields){
	
	foreach($fields as $field){
		// make sure each item exists within required fields that are arrays
		if(empty($_POST[$k][$field]) || !isset($_POST[$k][$field]) ){		
				$valid = false;
				array_push($errorMsg, 'Make sure that you entered a first name and last name!');
				break;
		}
	}
}

// validate email
if(!Util::validEmail($_POST['email'])){
	$valid = false;
	array_push($errorMsg, 'Please enter a valid email address!');
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
	die(header('Location: ../pages/create.php'));
}

// built correctly formatted array for saving record to db
$newRecord = $staff->build_staff_record_array($_POST);

// Add new record to db
$staff->insert_person($newRecord);

header('Location: ../index.php');

?>
