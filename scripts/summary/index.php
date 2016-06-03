<?php 
	// Main page functionality for admin	
	
	require_once 'includes/class.Staff.php';
	
	// set content to HTML, class.Person.php requires ini file
	header('Content-Type: text/html');

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
	
	<title>Ben's Projects</title>
</head>

<body>
	<div id="document" role="document" class="row">
		<div class="col-md-3">Management buttons will be here</div>
		<div class="col-md-9">Records will be here</div>
	</div>
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

