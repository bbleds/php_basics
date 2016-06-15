<?php 
require_once '../templates/navbar.php';
require_once '../../tt4lib/src/class.MDB.php';
require_once '../scripts/php/scripts.php';
// connect

$types = array('document', 'image', 'audio', 'video', 'link');
$statuses = array('active', 'inactive');
$requiredFields = array('title','desc','status','type');
$errorMsgs = array();
$data = array();
$id = (isset($_POST['editId']) && !empty($_POST['editId'])) ? $_POST['editId']: '';
$valid = true;
$dataCollection = $_POST;
$editMode = false;


// Set $id if 'id' query string exists in url
if(isset($_GET['id']) && !empty($_GET['id'])){
	try {
		$id = new MongoId($_GET['id']);
		$editMode = true;
		$resp = MDB::find('resource_management', array('_id'=>$id));
		$data = $resp['data']['rows'][0];
	}	catch (MongoException $e) {
		die('<p>There was an error! Invalid Id, please try again!</p><a href="admin.php"><button> Try Again</button></a>');
	}
}

// If form was posted, validate and store
if(isset($dataCollection['resource']) && !empty($dataCollection['resource'])){
	
	// set final required field based on type of resource
	switch($dataCollection['resource']['type']){
		case 'video':
			$requiredFields[] = 'embed_code';
			break;
		case 'link':
			$requiredFields[] = 'url';
			break;
		default:
			$requiredFields[] = 'file';	
	}
	
	// check/validate required fields
	foreach($requiredFields as $field){
		
		if($field == 'file'){
			// check if file name was specified
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
					$valid = false;
				// validate file name - check if file name already exists in 'files' directory 
				} elseif(file_exists('../files/'.$fileName)){
					$errorMsgs[] = '<p>Invalid file, a file already exists with that name, please try again!</p>';
					$valid = false;
				} else {
					$validFile = true;
				}
			}
		} else {
			// be sure required field is not empty
			$trimedField = trim($dataCollection['resource'][$field]);
			if(empty($trimedField)){
				$errorMsgs[] =  "<p>Please enter $field!</p>";
				$valid = false;
			}
		}	
	}

	// begin building newRecord for db
	$newRecord = $dataCollection['resource'];
	
	// if a file was submitted and valid and if fields are valid, save file to 'files' directory 
	if(isset($validFile) && $validFile && $valid){
		$tmp_name = $_FILES['file']['tmp_name'];
		$currentPath = pathinfo(getcwd());
		$projectDir = $currentPath['dirname'];
		$fileLocation = $projectDir.'/files/'.$fileName;
		
		//move from tmp to where we want it
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
			
		// update record if in edit mode
		if(isset($id) && !empty($id)){
			$id = new MongoId($id);
			// update
		// insert record into db if not in edit mode
		} else {
			// insert
		}
	
		// handle error
		if($resp['error']==1){
			$errorMsgs[] = 'Could not store in database, please try again!';
		} else {
			$success = true;
		}
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
	print '<div class="alert alert-danger">'.
	implode(' ', $errorMsgs).
	'</div>';
}

if(!isset($success)){
?>
					<form method="post" action="admin.php" enctype="multipart/form-data">
					<label>Title</label>
					<input class='form-control' name='resource[title]' type='text' value="<?php print getFieldData('title',$data) ?>"/>
					
					<label>Description</label>
					<input class='form-control' name='resource[desc]' type='text' value="<?php print getFieldData('desc',$data) ?>"/>
					
					<label>Status</label>
<?php 
print getSelectOptions($statuses, 'status');
?>						
					<label>Type</label>
<?php 
print getSelectOptions($types, 'type');

print '<label>Upload File</label>';
if(isset($data['type']) && $data['type'] == 'document'){
	print '<p>A file has been uploaded for this resource</p><br />';
} else {
?>	
					<input class='form-control' name='file' type='file' accept=".doc,.docx,.pdf,.jpg,.jpeg,.png,.gif,.mp3" />
<?php
}
?>				
					<label>Resource Link</label>
					<input class='form-control' name='resource[url]' type='url' value="<?php print getFieldData('url', $data) ?>" />
					
					<label>Video Embed Code</label>
					<input class='form-control' name='resource[embed_code]' type='text' value="<?php print getFieldData('embed_code', $data) ?>" />
					
					<input class='form-control' name='editId' type='hidden' value="<?php print $id ?>" />
					
					<button type="submit" class="btn btn-primary">Upload</button>
				</form>
<?php
} else {
	print '<div class="alert alert-success"><p>Saved resource successfully!!</p></div>'.
					'<a href="admin.php"><button class="btn btn-success">Add Another</button></a>'.
					'<a href="front_end.php"><button class="btn btn-primary">View Resources</button></a>'.
				'</div>';
}
?>
			</div>
		</div>

	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>	
</body>
