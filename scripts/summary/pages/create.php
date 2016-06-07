<?php
	// Functionality for adding new staff records to database

	define('ROOT_PATH', realpath($_SERVER['DOCUMENT_ROOT']));

	require_once ROOT_PATH.'/summary/includes/class.Staff.php';
	require_once ROOT_PATH.'/tt4lib/src/class.Util.php';


	session_start();

	// set content to HTML, class.Person.php requires ini file
	header('Content-Type: text/html');

	$staff = new Staff();


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

?>
		</div>
			<form method="post" onsubmit="return validateForm()" action="../scripts/create_handler.php">
				<h3>General</h3>

				<label for="first_name">First Name * </label>
				<input type="text" class="form-control required" name="name[first_name]" id="first_name" value="<?php print $staff->getSubmittedField('post_data','name','first_name'); ?>" />

				<label for="last_name">Last Name * </label>
				<input type="text" class="form-control required" name="name[last_name]" id="last_name" value="<?php print $staff->getSubmittedField('post_data','name','last_name'); ?>" />

				<label for="email">Email * </label>
				<input type="email" class="form-control required" name="email" id="email" value="<?php print $staff->getSubmittedField('post_data', 'email'); ?>" />

				<label for="phone">Phone Number</label>
				<input type="text" class="form-control" name="phone" id="phone" value="<?php print $staff->getSubmittedField('post_data', 'phone'); ?>" />

				<label for="position">Position</label>
				<input type="text" class="form-control" name="position" id="position" value="<?php print $staff->getSubmittedField('post_data', 'position'); ?>" />

				<label>Bio</label>
				<textarea class="form-control" name="bio"> <?php print $staff->getSubmittedField('post_data', 'bio'); ?> </textarea>

				<h3>Status *</h3>
<?php
// Output statuses                                      
$staff->output_staff_statuses($staff->statuses, false);
?>

				
				<h3>Preferred Contact Method</h3>
				
<?php 
// Output contact methods
$staff->output_contact_methods($staff->contact_methods, false);
?>				
				<hr>
				
				<h3>Social URLs</h3>
				
<?php
// Output social fields
$staff->output_social_fields($staff->socialSites, false);
?>
				
				<hr>
				<h3>Address</h3>
				<label for="street">Street</label>
				<input type="text" class="form-control" name="address[street]" id="street" value="<?php print $staff->getSubmittedField('post_data','address','street'); ?>"/>

				<label for="city">City</label>
				<input type="text" class="form-control" name="address[city]" id="city" value="<?php print $staff->getSubmittedField('post_data','address','city'); ?>" />

				<label for="state">State</label>
				
				<select class="form-control" name="state" value="<?php print $staff->getSubmittedField('post_data','state'); ?>">
<?php
 
$states = Util::getStateListData();

foreach($states as $state){
	print  "<option value='$state'> $state </option>";	
}
				
?>
			</select>

				<label for="zip">Zipcode</label>
				<input type="num" class="form-control" name="address[zip]" id="zip" value="<?php print $staff->getSubmittedField('post_data','address','zip'); ?>"/>

				<button type="submit" class="btn btn-primary">Add Member</button>
			</form>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../tt4lib/js/email_check.js"></script>	
	<script type="text/javascript" src="../scripts/client_validate.js"></script>	
	
	
</body>
</html>
