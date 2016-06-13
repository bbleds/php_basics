<?php 
require_once '../templates/navbar.php';

// types of media files 
$types = array('document', 'image', 'audio', 'video', 'link');
$statuses = array('active', 'inactive');

// prints option elements for each item in an array
//$colection = array
//$fieldName = fieldname on $_POST[resource]
function getSelectOptions($collection, $fieldName){
	$html = '';
	$html .= '<select class="form-control" name="resource['.$fieldName.']" type="text"><option value="">Select One</option>';
	foreach($collection as $option){
		$selected = '';
			if(isset($_POST['resource'][$fieldName]) && !empty($_POST['resource'][$fieldName])){
				if($_POST['resource'][$fieldName] == $option){
					$selected = 'selected';
				}
			}
		$html .= '<option value="'.$option.'" '.$selected.'>'.ucwords($option).'</option>';
	}
	$html .= '</select>';
	return $html;
}


$requiredFields = array('title','desc','status','type');
$valid = true;
$errorMsgs = array();

if(isset($_POST['resource']) && !empty($_POST['resource'])){
	if($_POST['resource']['type'] == 'image' || $_POST['resource']['type'] == 'document' || $_POST['resource']['type'] == 'audio'){
		$requiredFields[] = 'file';
	} else {
		$requiredFields[] = 'url';
	}
	
	// check/validate required fields
	foreach($requiredFields as $field){
		if($field == 'file'){
			if(!isset($_FILES['file']['name']) || empty($_FILES['file']['name'])){
				$errorMsgs[] = '<p>No file was uploaded!</p>';
				$valid = false;
			}	else {
				$fileName = $_FILES['file']['name'];			
				$allowedFileTypes = array('doc','docx','pdf','xls','xlsx','jpeg','jpg','png','gif','mp3');
				$fileInfo = pathinfo($fileName);
				// validate file type
				if(!in_array($fileInfo['extension'], $allowedFileTypes)){
					$errorMsgs[] = '<p>Invalid file, please upload a different file type!</p>';	
				}
				
				// if file name already exists
			}
		} else {
			$trimedField = trim($_POST['resource'][$field]);
			if(empty($trimedField)){
				$errorMsgs[] =  "<p>Please enter $field!</p>";
				$valid = false;
			}
		}	
	}
	
	// if valid
		// if file was uploaded
			// store file and referece to file
		//build newRecord with file reference or url built in
		//store file in db
	if($valid){
		print_r('Valid post!!!!');
	}
	
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

	<link type="text/css" rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'/>

	<title>Add Staff</title>
</head>

<body>
	<div id="document" role="document" class="container-fluid">
		<div class="row">
<?php 
print $navbar;
?>			
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
					<h3>Admin Resource Upload</h3>
					<hr>
<?php 
if(isset($errorMsgs) && !empty($errorMsgs)){
	print '<div class="alert alert-danger">';
	print implode(' ', $errorMsgs);
	print '</div>';
}
?>
					<form method="post" action="admin.php" enctype="multipart/form-data">
					<label>Title</label>
					<input class='form-control' name='resource[title]' type='text' value="<?php print isset($_POST['resource']['title']) ? $_POST['resource']['title'] : '' ?>"/>
					
					<label>Description</label>
					<input class='form-control' name='resource[desc]' type='text' value="<?php print isset($_POST['resource']['desc']) ? $_POST['resource']['desc'] : '' ?>"/>
					
					<label>Status</label>
<?php 
print getSelectOptions($statuses, 'status');
?>						
					<label>Type</label>
<?php 
print getSelectOptions($types, 'type');
?>
					
					<label>Upload File</label>
					<input class='form-control' name='file' type='file' accept=".doc,.docx,.pdf,.jpg,.jpeg,.png,.gif,.mp3" />
					
					<label>Resource Link</label>
					<input class='form-control' name='resource[url]' type='url' value="<?php print isset($_POST['resource']['url']) ? $_POST['resource']['url'] : '' ?>" />
					
					<button type="submit" class="btn btn-primary">Upload</button>
				</form>
			</div>
		</div>

	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>	
</body>
