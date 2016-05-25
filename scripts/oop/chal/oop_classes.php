<?php

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
	 * Prints the $first_name and $last_name class properties
	 *
	 * @access private
	 *
	 * @return void
	 */
	public function get_name(){
		print $this->first_name . " " . $this->last_name;	
	}
	
	/**
	 * Person::set_name()
	 *
	 * Sets the $first_name and $last_name class properties
	 *
	 * @access private
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
	
	private function get_email(){
		print $this->email;	
	}
	
	private function get_phone(){
		print $this->phone;	
	}
}

$example = new Person();

$example->set_name("Ben", "Bledsoe");
$example->get_name();

?>
