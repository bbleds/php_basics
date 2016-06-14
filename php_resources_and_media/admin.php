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
	if($_POST['resource']['type'] == 'video'){
		$requiredFields[] = 'embed_code';
	} elseif($_POST['resource']['type'] == 'link') {
		$requiredFields[] = 'url';
	} else {
		$requiredFields[] = 'file';	
	}
	
	// check/validate required fields
	foreach($requiredFields as $field){
		// if file was required, validate file name and extention
		if($field == 'file'){
			if(!isset($_FILES['file']['name']) || empty($_FILES['file']['name'])){
				$errorMsgs[] = '<p>No file was uploaded!</p>';
				$valid = false;
			}	else {
				$fileName = $_FILES['file']['name'];			
				$allowedFileTypes = array('doc','docx','pdf','xls','xlsx','jpeg','jpg','png','gif','mp3');
				$fileInfo = pathinfo($fileName);
				// validate file type and name
				if(!in_array($fileInfo['extension'], $allowedFileTypes)){
					$errorMsgs[] = '<p>Invalid file, please upload a different file type!</p>';	
					$valid = false;
				} elseif(file_exists('../files/'.$fileName)){
					$errorMsgs[] = '<p>Invalid file, a file already exists with that name, please try again!</p>';
					$valid = false;
				} else {
					$validFile = true;
				}
			}
		} else {
			$trimedField = trim($_POST['resource'][$field]);
			if(empty($trimedField)){
				$errorMsgs[] =  "<p>Please enter $field!</p>";
				$valid = false;
			}
		}	
	}
	

	// begin building newRecord for db
	$newRecord = $_POST['resource'];
	
	// save file to files directory
	if(isset($validFile) && $validFile){
		//move from tmp to where we want it
		$tmp_name = $_FILES['file']['tmp_name'];
		$currentPath = pathinfo(getcwd());
		$projectDir = $currentPath['dirname'];
		$fileLocation = $projectDir.'/files/'.$fileName;
		
		if(move_uploaded_file($tmp_name, $fileLocation)){
			$finalLocation = '/files/'.$fileName;
			$newRecord['link'] = $finalLocation;
		} else {
			$errorMsgs[]='File could not be saved, please try again!';
			$valid = false;	
		}
	}
	
	// finish building newRecord and save to db
	if($valid){
			
	// clear empty values/ trim and escape input
	foreach($newRecord as $key=>$value){
		if(empty($value)){
			unset($newRecord[$key]);
		} elseif($key != 'embed_code'){
			$newRecord[$key] = htmlspecialchars(trim($value));
		}
	}
		
			// store record in db
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
					
					<label>Video Embed Code</label>
					<input class='form-control' name='resource[embed_code]' type='text' value="<?php print isset($_POST['resource']['embed_code']) ? $_POST['resource']['embed_code'] : '' ?>" />
					
					<button type="submit" class="btn btn-primary">Upload</button>
				</form>
			</div>
		</div>

	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>	
</body>
