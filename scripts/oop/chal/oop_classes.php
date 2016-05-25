<?php
require_once "../ini.php";

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

$example = new Person();
?>
