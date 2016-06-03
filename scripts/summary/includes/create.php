<?php
	// Functionality for adding new staff records to database

	define('ROOT_PATH', realpath($_SERVER['DOCUMENT_ROOT']));

	require_once ROOT_PATH.'/summary/includes/class.Staff.php';

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
			<form>
				<h3>General</h3>

				<label for="first_name">First Name * </label>
				<input type="text" class="form-control required" name="name['first_name']" id="first_name"/>

				<label for="last_name">Last Name * </label>
				<input type="text" class="form-control required" name="name['last_name']" id="last_name"/>

				<label for="email">Email * </label>
				<input type="text" class="form-control required" name="email" id="email"/>

				<label for="phone">Phone Number</label>
				<input type="text" class="form-control" name="phone" id="phone"/>

				<label for="position">Position</label>
				<input type="text" class="form-control" name="psotion" id="position"/>

				<label for="bio">Bio</label>
				<input type="text" class="form-control" name="bio" id="bio"/>

				<h3>Status</h3>
				<label><input type="radio" class="radio" name="status[]" value="active"/> Active</label>
				<label><input type="radio" class="radio" name="status[]" value="inactive"/> Inactive</label>
				
				<h3>Preferred Contact Method</h3>
				<label><input type="checkbox" class="checkbox" name="contact_methods[]" value="email"/> Email</label>
				<label><input type="checkbox" class="checkbox" name="contact_methods[]" value="phone"/> Phone</label>
				
				<hr>
				<h3>Address</h3>
				<label for="street">Street</label>
				<input type="text" class="form-control" name="address['street']" id="street"/>

				<label for="city">City</label>
				<input type="text" class="form-control" name="address['city']" id="city"/>

				<label for="state">State</label>
				<select class="form-control" name="address['state']" id="state">
					<option>Test</option>
					<option>Test</option>
					<option>Test</option>
				</select>

				<label for="zip">Zipcode</label>
				<input type="num" class="form-control" name="address['zip']" id="zip"/>

				<button type="submit" class="btn btn-primary">Add Member</button>
			</form>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
