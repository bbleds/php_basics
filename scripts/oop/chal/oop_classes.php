<?php
require_once "../ini.php";
require_once "../advanced_arrays/advanced_arrays.php";

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
}

//Clear screen of prints from required advanced_arrays.php
ob_clean();

//Goal One 
$bob = new Person();

$bob->set_name($people[0]['first_name'], $people[0]['last_name']);
$bob->set_email($people[0]['email']);
$bob->set_phone($people[0]['phone']);
$bob->set_address($people[0]['address']);

$bob->get_name();
$bob->get_email();
$bob->get_phone();
$bob->get_address();

print "\n";

$sue = new Person();

$sue->set_name("Sue", "Smith");
$sue->set_email($people[1]['email']);
$sue->set_phone($people[1]['phone']);
$sue->set_address($people[1]['address']);

$sue->get_name();
$sue->get_email();
$sue->get_phone();
$sue->get_address();
?>
