<?php

// Goal one
print_r($_POST);

// Prints a value for a set input box if a form has been submitted previously or returns empty string if not
function print_val($fieldName){
	$fieldValue = "";

	if(isset($_POST[$fieldName])){
		$fieldValue = filter_input(INPUT_POST, $fieldName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	print $fieldValue;
}

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

<title>Form Project</title>
</head>

<body>
<div id="document" role="document">

<h1>Contact</h1>

<?php
// conditionally display form if required input fields are empty
if(
isset($_POST['submitCheck']) &&
(!isset($_POST['firstName']) || trim($_POST['firstName']) === "" ||
!isset($_POST['lastName']) || trim($_POST['lastName']) === "" ||
!isset($_POST['email']) || trim($_POST['email']) === "")
){
print "Please enter all required fields";
}
?>

<form method="post" action="forms.php">
<ul>
<li>First Name (required): <input type="text" name="firstName" value="<?php print_val('firstName'); ?>"/></li>
<li>Last Name (required): <input type="text" name="lastName" value="<?php print_val('lastName') ?>"/></li>
<!-- for practice, set email to type text for later validation -->
<li>Email (required): <input type="text" name="email" value="<?php print_val('email') ?>"/></li>
<li>Phone: <input type="text" name="phone" value="<?php print_val('phone') ?>"/></li>
<li>Address: <input type="text" name="address" value="<?php print_val('address') ?>"/></li>
<li>City: <input type="text" name="city" value="<?php print_val('city') ?>"/></li>
<li>State: <input type="text" name="state" value="<?php print_val('state') ?>"/></li>
<li>Zipcode: <input type="text" name="zipcode" value="<?php print_val('zipcode') ?>"/></li>
<li>Comments: <textarea name="comments"><?php print_val('comments') ?></textarea></li>
<input type="hidden" value="1" name="submitCheck"/>
<li><input type="submit"/></li>
</ul>
</form>

</div>
</body>
</html>
