<?php

define('ROOT', realpath($_SERVER['DOCUMENT_ROOT']));


/**
 * @author Ben Bledsoe
 * @copyright 2016, The A Group
 *
 * Holds personal information and address for a specific person
 */
class Person
{
	private $first_name;
	private $last_name;
	private $email;
	private $phone;
	private $address = array();
	
	protected $dbCollectionName = 'people';

	/**
	 * Person::__constuct()
	 *
	 * Sets the $first_name, $last_name, $email, and $phone properties on instantiation
	 *
	 * @access public
	 *
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $email
	 * @param string $phone
	 *
	 * @return void
	 */
	public function __construct($firstName = "", $lastName = "", $email = "", $phone = ""){
		//print "Waking up, \n";
		$this->first_name = $firstName;
		$this->last_name = $lastName;
		$this->email = $email;
		$this->phone = $phone;
	}

	/**
	 * Person::__destruct()
	 *
	 * Prints an ending message after final reference to object
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function __destruct(){
		//print "\nNap Time for " . $this->first_name;
	}

	/**
	 * Person::get_name()
	 *
	 * Prints the $first_name and $last_name properties
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function get_name(){
		print $this->first_name . " " . $this->last_name . "\n";
	}

	/**
	 * Person::set_name()
	 *
	 * Sets the $first_name and $last_name properties
	 *
	 * @access public
	 *
	 * @param string $firstName
	 * @param string $lastName
	 *
	 * @return void
	 */
	public function set_name($firstName, $lastName){
		$this->first_name = $firstName;
		$this->last_name = $lastName;
	}

	/**
	 * Person::get_email()
	 *
	 * Prints the $email property
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function get_email(){
		print $this->email . "\n";
	}

	/**
	 * Person::set_email()
	 *
	 * Sets the $email property
	 *
	 * @access public
	 *
	 * @param string $email
	 *
	 * @return void
	 */
	public function set_email($email){
		$this->email = $email;
	}

	/**
	 * Person::get_phone()
	 *
	 * Prints the $phone property
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function get_phone(){
		print $this->phone . "\n";
	}

	/**
	 * Person::set_phone()
	 *
	 * Sets the $phone property
	 *
	 * @access public
	 *
	 * @param string $phone
	 *
	 * @return void
	 */
	 public function set_phone($phone){
	 	$this->phone = $phone;
	 }

	/**
	 * Person::get_address()
	 *
	 * Prints each array value in the $address property
	 *
	 * @access public
	 *
	 * @return void
	 */
	 public function get_address(){
	 	print "address: " . implode(", ", $this->address) . "\n";
	 }

	/**
	 * Person::set_address()
	 *
	 * Sets the $address property
	 *
	 * @access public
	 *
	 * @param array $address_array
	 *
	 * @return void
	 */
	 public function set_address($address_array){
		foreach($address_array as $key => $value){
			$this->address[$key] = $value;
		}
	 }

	/**
	 * Person::get_full_person()
	 *
	 * Calls the get_name(), get_email(), get_phone(), and get_address() methods on the object passed in
	 *
	 * @access public
	 *
	 * @uses object Person
	 *
	 * @return void
	 */
	 public function get_full_person(){
		$this->get_name();
		$this->get_email();
		$this->get_phone();
		$this->get_address();
	 }

	/**
	 * Person::insert_person()
	 *
	 * Inserts a new person record into db 'person' collection
	 *
	 * @access public
	 *
	 * @param array $person
	 *
	 * @return object 
	 */
	 public static function insert_person($person){
	 	$resp = MDB::insert('people', $person);
	 	
	 	// get _id from response
	 	return $resp['data']['rows'][0]['_id'];
	 }
	 
	/**
	 * Person::find_all()
	 *
	 * Returns all records in the 'people' collection
	 *
	 * @access public
	 *
	 * @return array people
	 */
	public static function find_all(){
			
			$resp = MDB::find('people', array(), array('email'=>1));
		
			return $resp;
	}
	
	/**
	 * Person::find_one()
	 *
	 * Returns a record with a specific id 
	 *
	 * @access public
	 *
	 * @param string $id
	 *
	 * @return array $resp
	 */
	public static function find_one($id){
		$resp = MDB::findById('people', $id);
		
		return $resp;
	} 
	
	/**
	 * Person::find_one_test()
	 *
	 * Returns a record with a specific id 
	 *
	 * @access public
	 *
	 * @param string $id
	 *
	 * @return array $resp
	 */
	public static function find_one_test($id){
		if(!is_object($id)){
			try {
				$id = new MongoId($id);
			} catch(MongoException $e) {
				die(print_r($e->getMessage()));
			}
		}
		
		$resp = MDB::find('people', array('_id'=>$id), array(), array(0,1), array('first_name', 'last_name', 'email'));
		
		return $resp;
	}
	
	/**
	 * Person::update()
	 *
	 * Update information for a person record in the db
	 *
	 * @access public
	 *
	 * @param string $id
	 * @param array $update
	 *
	 * @return bool $status
	 */
	public static function update($id , $update){
		if(!is_object($id)){
			try {
				$id = new MongoId($id);
			} catch(MongoException $e) {
				die(print_r($e->getMessage()));
			}
		}
		
		$resp = MDB::update('people',array('_id'=>$id),$update);
		
		$status = self::_query_status($resp);
		
		return $status;
	}

	/**
	 * Person::delete()
	 *
	 * Removes a record from the database by record id
	 *
	 * @access public
	 *
	 * @param string $id
	 *
	 * @return bool $status
	 */
	public static function delete($id){
			$resp = MDB::deleteById('people', $id);
			
			$status = self::_query_status($resp); 
		
			return $status;
	}
	
	/**
	 * Person::_query_status()
	 *
	 * Run MDB query and return true or false based on the 'error' key returned from query
	 *
	 * @access private
	 *
	 * @param function $query
	 *
	 * @return bool $returnStatus
	 */	 
	 private static function _query_status($query){
		$returnStatus = true;
	 	
		// Store inserted record information in $dbStatus
	 	$dbStatus = $query;

 		if($dbStatus['error']){
 			$returnStatus = false;
 		}

	 	return $returnStatus;
	 }
}
?>
