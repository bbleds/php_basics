<?php
require_once "../ini.php";
require_once "../includes/people_arrays.inc.php";

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
		print "Waking up, \n";
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
		print "\nNap Time for " . $this->first_name;
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
	 
}

//Goal One - without constructor
$bob = new Person();

$bob->set_name($people[0]['first_name'], $people[0]['last_name']);
$bob->set_email($people[0]['email']);
$bob->set_phone($people[0]['phone']);
$bob->set_address($people[0]['address']);

$bob->get_full_person();

print "\n";

$sue = new Person();

$sue->set_name("Sue", "Smith");
$sue->set_email($people[1]['email']);
$sue->set_phone($people[1]['phone']);
$sue->set_address($people[1]['address']);

$sue->get_full_person();

print "\n";

//Goal two - with constructor
$john = new Person($people[2]['first_name'],$people[2]['last_name'],$people[2]['email'],$people[2]['phone']);
$john->set_address($people[2]['address']);

$john->get_full_person();

?>
