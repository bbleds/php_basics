<?php
/**
 * print_val()
 *
 * Conditionally prints the value for a set input box if a form has been submitted or empty string if input box is not set
 *
 * @access public
 * @param string $fieldName
 *
 * @return void
 */
function print_val($fieldName){
	$fieldValue = "";
	if(isset($_POST[$fieldName])){
		$fieldValue = filter_input(INPUT_POST, $fieldName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	print $fieldValue;
}
/**
 * validate_comment()
 *
 * Validates the comment text box input to a certain length, defaults to a length of 200 characters
 *
 * @access public
 * @param int $length
 *
 * @return bool
 */
function validate_comment($length=200){
	$checkValid = false;
	if(isset($_POST['comments']) && strlen($_POST['comments']) < $length){
		$checkValid = true;
	}
	return $checkValid;
}
/**
 * validate_state()
 *
 * Validates the state text input, if entered, to allow only a two-letter string abbreviation
 *
 * @access public
 *
 * @return bool
 */
function validate_state(){
	$checkValid = false;
	if(isset($_POST['state']) && $_POST['state'] != ""){
			if(!preg_match('/[0-9]/',$_POST['state']) && trim(strlen($_POST['state'])) == 2){
				$checkValid = true;
			}
	} else {
		$checkValid = true;
	}
	return $checkValid;
}
/**
 * validate_email()
 *
 * Validates the email text input, checking for occurences and correct order of '@' and '.' characters
 *
 * @access public
 *
 * @return bool
 */
function validate_email(){
	$checkValid = false;
	if(isset($_POST['email'])){
		if(
			strpos($_POST['email'],'.') !== false &&
			substr_count($_POST['email'], '@') == 1 &&
			strpos($_POST['email'],'.') > strpos($_POST['email'],'@')
		){
			$checkValid = true;
		}
	} else {
		$checkValid = true;
	}
	return $checkValid;
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
// Goal one: validate required fields - display error message or print valid form submission
$isValid = false;
if(
	isset($_POST['submitCheck']) &&
	(!isset($_POST['firstName']) || trim($_POST['firstName']) === "" ||
	!isset($_POST['lastName']) || trim($_POST['lastName']) === "" ||
	!isset($_POST['email']) || trim($_POST['email']) === "")
){
	print "Please enter all required fields";
} else {
	// Extra Goal: validate comment, state, and email
	if(validate_comment() && validate_state() && validate_email()){
		$isValid = true;
		$name = "";
		foreach($_POST as $field => $value){
			if($field == 'submitCheck'){
				print "name: $name";
			} elseif($field == 'firstName' || $field == 'lastName') {
				$name .= "$value ";
			} else {
				print "$field: $value <br />";
			}
		}
	} elseif(isset($_POST['submitCheck'])) {
		print "There was a problem with the submission, please try again";
	}
}
// display form if form has not been submitted or is not valid
if(!isset($_POST['submitCheck']) || $isValid == false){
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

<?php
// end if
}
?>

	</div>
</body>
</html>
