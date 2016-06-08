<?php
// Functionality for editing existing records in db

define('ROOT_PATH', realpath($_SERVER['DOCUMENT_ROOT']));

require_once ROOT_PATH.'/summary/includes/class.Staff.php';
require_once ROOT_PATH.'/tt4lib/src/class.Util.php';

// check for empty or unspecified id
if(	!isset($_GET['id']) || empty($_GET['id']) ){
	die('There was an error retrieving that page, invalid ID, please try again! <br/><a href="../index.php">Go Back!</a>');
}

session_start();

// set content to HTML, class.Person.php requires ini file
header('Content-Type: text/html');

$id = $_GET['id'];
$staff = new Staff();
$resp = $staff->find_one($id);

// die if no results/ bad id
if($resp['error']){
	die('There was an error retrieving that page, please try again! <br/><a href="../index.php">Go Back!</a>');
}

$staffMember = $resp['data']['rows'][0];
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="keywords" content="ben" />
	<meta name="description" content="Ben." />
	<meta name="author" content="Ben" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />

	<link type="text/css" rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'/>

	<title>Add Staff</title>
</head>

<body>
	<div id="document" role="document" class="row">
		<div class="col-md-3">
			<a href="../index.php"><button class="btn btn-block">Home</button></a>
			<a href="create.php"><button class="btn btn-block">Add</button></a>
		</div>
		<div class="col-md-8">

		<div id="error_box" class="alert-danger">
<?php

if(isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ){

	print 'There was an error!';
	foreach($_SESSION['error_msg'] as $error){
		print '<p>'.$error.'</p>';
	}
}


die(print_r($_SESSION['post_data']));

function getSubmitOrExistingField($staffData, $topField, $midField, $bottomField){
// get session data
$staff->getSubmittedField();
	
// else
// get existing general field 
}

?>
		</div>			

			<form method="post" onsubmit="return validateForm()" action="../scripts/update_handler.php">
				<h3>General</h3>
				
				<label for="first_name">First Name * </label>
				<input type="text" class="form-control required" name="name[first_name]" id="first_name" value="<?php print $staff->get_existing_general_field($staffMember, 'first_name') ?>"/>

				<label for="last_name">Last Name * </label>
				<input type="text" class="form-control required" name="name[last_name]" id="last_name" value="<?php print $staff->get_existing_general_field($staffMember, 'last_name') ?>"/>

				<label for="email">Email * </label>
				<input type="email" class="form-control required" name="email" id="email" value="<?php print $staff->get_existing_general_field($staffMember, 'email') ?>"/>

				<label for="phone">Phone Number</label>
				<input type="text" class="form-control" name="phone" id="phone" value="<?php print $staff->get_existing_general_field($staffMember, 'phone') ?>"/>

				<label for="position">Position</label>
				<input type="text" class="form-control" name="position" id="position" value="<?php print $staff->get_existing_general_field($staffMember, 'position') ?>"/>
				
				<label>Bio</label>
				<textarea class="form-control" name="bio"><?php print $staff->get_existing_general_field($staffMember, 'bio') ?></textarea>
				
				<h3>Status</h3>
<?php 
$staff->output_staff_statuses($staff->statuses,true, $staffMember);				
?>				

				<h3>Preferred Contact Method</h3>
<?php 
if(!isset($staffMember['contact_methods'])){
	$staff->output_contact_methods($staff->contact_methods, false, $staffMember);
} else {
	$staff->output_contact_methods($staff->contact_methods, true, $staffMember);
}


?>
				
				<hr>
				<h3>Social URLs</h3>
<?php
if(!isset($staffMember['social'])){
	$staff->output_social_fields($staff->socialSites, false, $staffMember);
} else {
	$staff->output_social_fields($staff->socialSites, true, $staffMember);	
}
?>
				<hr>
				<h3>Address</h3>
<?php 

$street = isset($staffMember['address']['street']) ? $staffMember['address']['street'] : '';
$city = isset($staffMember['address']['city']) ? $staffMember['address']['city'] : '';
$state = isset($staffMember['address']['state']) ? $staffMember['address']['state'] : '';
$zip = isset($staffMember['address']['zip']) ? $staffMember['address']['zip'] : '';

?>				
				<label >Street</label>
				<input type="text" class="form-control" name="address[street]" value="<?php print $street ?>"/>

				<label>City</label>
				<input type="text" class="form-control" name="address[city]" value="<?php print $city ?>"/>

				<label >State</label>
				<select class="form-control" name="state" value="<?php print $state ?>">
<?php
 
$states = Util::getStateListData();

foreach($states as $state){
	print  "<option value='$state'> $state </option>";	
}
				
?>
			</select>

				<label for="zip">Zipcode</label>
				<input type="num" class="form-control" name="address[zip]" id="zip" value="<?php print $zip ?>"/>
				<input type="hidden" name="id" value="<?php print $_GET['id'] ?>" />
				
				<button type="submit" class="btn btn-primary">Update Member</button>
			</form>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../tt4lib/js/email_check.js"></script>	
	<script type="text/javascript" src="../scripts/client_validate.js"></script>	
	
	
</body>
</html>
