<?php 

define('SITES_PATH', realpath($_SERVER['DOCUMENT_ROOT']));

require_once SITES_PATH.'/oop/class.Person.php';
require_once SITES_PATH.'/tt4lib/src/class.MDB.php';
require_once SITES_PATH.'/tt4lib/src/class.Util.php';

/**
 * @author Ben Bledsoe
 * @copyright 2016, The A Group
 *
 * Extends person class with properties and methods for managing summary_staff records, admin module for managing staff
 */
class Staff extends Person 
{
	
	protected $dbCollectionName = 'summary_staff';
	public $socialSites = array('blog','twitter','facebook','linkedIn','google plus', 'snapchat');
	public $contact_methods = array('email', 'phone');
	public $statuses = array('active', 'inactive');
	
	/**
	 * Staff::output_social_fields()
	 *
	 * Outputs a prefilled input for each social site that user saved and an empty input for each social site user has not saved
	 *
	 * @access public
	 * @access public
	 *
	 * @param array $sites -- the sites to check for
	 * @param bool $recordExists
	 * @param array $data -- record in db
	 *
	 * @return void
	 */
	 public function output_social_fields($sites, $recordExists, $data=array()){
		
		if(!$recordExists){
			
			// print input field for each site is $socialSite
			foreach($sites as $site){
				print '<label>' . ucwords($site) .'</label>';
				print '<input type="url" class="form-control" name="social[' . $site .']" value="'.$this->getSubmittedField('post_data','social', $site).'"/>';
			}
			
		}	else {
			// store all sites user has entered
			$enteredSites = array(); 

			foreach($sites as $site){
				
				// if $site is on session, print an input populated with the site on session
				if(isset($_SESSION['post_data']['social'][$site]) && !empty($_SESSION['post_data']['social'][$site])){
							print '<label>' . ucwords($site) .'</label>';
							print '<input type="url" class="form-control" name="social['. $site .']" value="'.$_SESSION['post_data']['social'][$site].'" />';
							$enteredSites[] = $site;
				} else {
				
					// if the site exists in the db, print an input populated with site link from db
					for($i = 0; $i < count($data['social']); $i++){
				 		if($data['social'][$i]['name'] == $site){
							print '<label>' .ucwords($site) .'</label>';
							print '<input type="url" class="form-control" name="social['. $site  .']" value="'.$data['social'][$i]['link'] .'"/>';
							$enteredSites[] =  $data['social'][$i]['name'];
							break;
						}
					}
				}				
			}
			
			// find the difference between the two arrays, and output an empty field for those that user has not entered 
			foreach(array_diff($sites, $enteredSites) as $diff){
				print '<label>' . ucwords($diff) .'</label>';
				print '<input type="url" class="form-control" name="social[' . $diff .']" />';
			}     
		}
	    
	}
	
	/**
	 * Staff::output_staff_status()
	 *
	 * Outputs radio button inputs, appropriate button is checked based on user input
	 *
	 * @access public
	 *
	 * @param string $statuses
	 * @param bool $recordExists
	 * @param array $data
	 *
	 * @return void
	 */
	 public function output_staff_statuses($statuses, $recordExists, $data=array()){
	 	
	 	print "<ul>";
	 	
	 	if(!$recordExists){
	 		
	 		foreach($statuses as $status){
	 			print '<li><label><input type="radio" name="status" value="' . $status.'"';
	 			
	 			// if status exists on session
	 			if($_SESSION['post_data']['status']){
	 				// if value is value of current status
	 				if($_SESSION['post_data']['status'] == $status){
	 					print "checked";
	 				}
	 			}
	 			
	 			print '/>'. ucwords($status) .'</label></li>';	
	 		}
	 		
	 	} else {

			// if status exists on session, use that, else use the data from post
			$currentStatus = isset($_SESSION['post_data']['status']) ? $_SESSION['post_data']['status'] : $data['status'];			
			
		
			$existingStatus = array($currentStatus);
		
			// print current status
			print '<li><label><input type="radio" name="status" value="' . $currentStatus . '" checked />'. ucwords($currentStatus) .'</label></li>';
		
			$diffItems = array_diff($statuses, $existingStatus); 
			foreach($diffItems as $diff){
				print '<li><label><input type="radio" name="status" value="' . $diff . '"/>'. ucwords($diff) .'</label></li>';
			}
		}
		
		print "</ul>";
	}
	
	/**
	 * Staff::output_contact_methods()
	 *
	 * Outputs a checkbox for each item in $contact_methods, checkbox is checked if it exists on user
	 *
	 * @access public
	 *
	 * @param string $contact_methods
	 * @param bool $recordExists
	 * @param array $data
	 *
	 * @return void
	 */
	 public function output_contact_methods($contact_methods, $recordExists, $data=array()){
	
		print '<ul>';

		if(!$recordExists){
			
			foreach($contact_methods as $method){
				print '<li><label><input type="checkbox" name="contact_methods[]" value="' . $method . '"';
				
				// if contact_methods exist on session
				if($_SESSION['post_data']['contact_methods']){
					
					// loop contact methods saved in session and output checked for any that match current $method
					foreach($_SESSION['post_data']['contact_methods'] as $submittedMethod){
						if($submittedMethod == $method){
							print 'checked';
						}
					}
				}
				
				print  '/>'. ucwords($method) .'</label></li>';
			}
		} else {
	
			// print each selected item
		 	foreach($data['contact_methods'] as $method){
		 		print '<li><label><input type="checkbox" name="contact_methods[]" value="' . $method . '" checked />'. ucwords($method) .'</label></li>';
		 	}
		 	
		 	// print each unselected item
		 	$diffItems = array_diff($contact_methods, $data['contact_methods']);
		 	foreach($diffItems as $diff){
		 		print '<li><label><input type="checkbox" name="contact_methods[]" value="' . $diff . '" />'. ucwords($diff) .'</label></li>';
		 	}
		}
		
		print '</ul>';
	}
	
	/**
	 * Staff::get_existing_general_fields()
	 *
	 * Returns a field value if it exists within a certain data set or empty string if it does not exist
	 *
	 * @access public
	 *
	 * @param array $data
	 * @param string $fieldname
	 *
	 * @return string $value
	 */
	 public function get_existing_general_field($data, $fieldName){
		
		if( !isset($data[$fieldName]) || empty($data[$fieldName]) ){
			$value = '';
		} else {
			$value = $data[$fieldName];
		}
	
		return $value;	
	}
	
	/**
	 * Staff::build_staff_record_array()
	 *
	 * Returns an array that can be used to post new staff records to db or update existing members in db
	 *
	 * @access public
	 *
	 * @param array $data
	 *
	 * @return array $newRecord
	 */
	 public function build_staff_record_array($data){
		// build new record to be inserted into db
		$newRecord = array();
		$newRecord['date_posted'] = new MongoDate();
		
		// key names in $_POST that should be pushed into $newRecord immediately
		$immediateKeysToPush = array('email', 'phone', 'position', 'bio', 'status', 'contact_methods');
		
		// if position is not set, push a default position
		if(!isset($newRecord['position']) || empty($newRecord['position']) ){
			$newRecord['position'] = 'team member';
		}
		
		// loop through $immediateKeysToPush and push into $newRecord array
		foreach($immediateKeysToPush as $key){
			if(isset($data[$key]) && !empty($data[$key])){
				$newRecord[$key] = $data[$key];
			}
		}
		
		// for each item in name array, push key value pair into the $newRecord array
		foreach($data['name'] as $k=>$v){
			$newRecord[$k] = $v;
		}  
		
		//build address array
		$address = $data['address'];
		$address['state'] = $data['state'];
		
		foreach($address as $key=>$value){
			if(!empty($address[$key])){
				$newRecord['address'][$key] = $address[$key];
			}
		}
		
		//build social array
		foreach($data['social'] as $k=>$v){
			if(!empty($data['social'][$k])){
				$newRecord['social'][] = array('name'=>$k,'link'=>$v);
			}
		}
		
		return $newRecord;
	}

	public function validate_required_string_fields(){
		//place code here to run	
	}
	
	/**
	 * Staff::validate_mongo_id()
	 *
	 * Validate that an id exists and is a valid MongoId object
	 *
	 * @access public
	 * 
	 * @param string|object $id
	 *
	 * @return object|bool $id
	 */
	public function validate_mongo_id($id){
		if( empty($id) ){
			return false;
		}
		
		if( !is_object($id) ){
			try {
				$id = new MongoId($id);		
			}	catch (MongoException $e) {
				return false;
			}
		}
		
		return $id;
	}
	
	/**
	 * Staff::getSumbittedField()
	 *
	 * returns the value of a field that has been submitted, allows for triple nested data
	 *
	 * @access public
	 * 
	 * @param string $topLevel
	 * @param string $midLevel
	 * @param string $bottomLevel
	 *
	 * @return string $fieldValue
	 */
	public function getSubmittedField($topLevel, $midLevel='', $bottomLevel=''){
		if(empty($_SESSION[$topLevel])){
			return '';
		}
		
		$fieldValue='';
		
		if( empty($midLevel) && empty($bottomLevel) ){
			$fieldValue = $_SESSION[$topLevel];
		}
		
		if( empty($bottomLevel) && !empty($midLevel) ){
			$fieldValue = $_SESSION[$topLevel][$midLevel];
		}
		
		if( !empty($bottomLevel) && !empty($midLevel) ){
			$fieldValue = $_SESSION[$topLevel][$midLevel][$bottomLevel];
		}
	
		return $fieldValue;
	}
	
	
	/**
	 * Staff::validatePostFields()
	 *
	 * validates post data
	 *
	 * @access public
	 * 
	 * @param array $postData
	 *
	 * @return array $status
	 */
	public function validatePostFields($postData){
		$errorMsg = array();
		$valid = true;
		$requiredStringFields = array('email', 'status');
		$requiredArrayFields = array('name'=>array('first_name', 'last_name')); 
		$util = new Util();
		
		// validate that $requiredStringFields exist in $_POST
		foreach($requiredStringFields as $field){	
			// be sure field is not empty and isset
			if(empty($postData[$field]) || !isset($postData[$field])){
				$valid = false;	
				array_push($errorMsg, 'Make sure that you entered an email and selected a status!');
				break;
			}
		}
		
		// validate that fields within $requiredArrayFields exist in $_POST
		foreach($requiredArrayFields as $k=>$fields){
			
			foreach($fields as $field){
				// make sure each item exists within required fields that are arrays
				if(empty($postData[$k][$field]) || !isset($postData[$k][$field]) ){		
						$valid = false;
						array_push($errorMsg, 'Make sure that you entered a first name and last name!');
						break;
				}
			}
		}
		
		// validate email
		if(!$util->validEmail($postData['email'])){
			$valid = false;
			array_push($errorMsg, 'Please enter a valid email address!');
		}
		
		$status = array('valid'=>$valid, 'error'=>$errorMsg);
	
		return $status;
	}

}

MDB::connect('bentt4');
?>
