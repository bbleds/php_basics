<?php 
require_once "../ini.php";
require_once "../includes/people_arrays.inc.php";

/**
 * @author Ben Bledsoe
 * @copyright 2016, The A Group
 *
 * Holds personal information and address for a specific person
 */
class PersonStatic
{
	private static $first_name;	
	private static $last_name;	
	private static $email;	
	private static $phone;	
	private static $address = array();
	
	/**
	 * Person::get_name()
	 *
	 * Prints the $first_name and $last_name properties
	 *
	 * @access public
	 *
	 * @return void
	 */
	 public static function get_name(){
	 		print self::$first_name . " " . self::$last_name . "\n"; 
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
	 public static function set_name($firstName, $lastName){
	 		self::$first_name = $firstName;
	 		self::$last_name = $lastName;
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
	 public static function get_email(){
	 	print self::$email . "\n";	
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
	public static function set_email($email){
		self::$email = $email;
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
	 public static function get_phone(){
	 	print self::$phone . "\n";
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
	 public static function set_phone($phone){
	 	self::$phone = $phone;
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
	 public static function get_address(){
	 	print "Address: " . implode(", ", self::$address) . "\n";	
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
	 public static function set_address($address_array){
	 	foreach($address_array as $key => $value){
	 		self::$address[$key] = $value;
	 	}
	 }

	/**
	 * Person::get_full_person()
	 *
	 * Calls the get_name(), get_email(), get_phone(), and get_address() methods
	 *
	 * @access public
	 * 
	 * @return void
	 */
	public static function get_full_name(){
		self::get_name();
		self::get_email();
		self::get_phone();
		self::get_address();
	}
}

PersonStatic::set_name("John", "Doe");
PersonStatic::set_email("example@gmail.com");
PersonStatic::set_phone("(111) 111-1111");
PersonStatic::set_address($people[0]['address']);

PersonStatic::get_full_name();
?>
