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
	 * @static
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
	 * @static
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
	 * @static
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
	 * @static
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
	 * @static
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
	 * @static
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
	 * @static
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
	 * @static
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
	 * @static
	 * 
	 *
	 * @return void
	 */
	public static function get_full_name(){
		PersonStatic::get_name();
		PersonStatic::get_email();
		PersonStatic::get_phone();
		PersonStatic::get_address();
	}
}

PersonStatic::set_name("Ben", "Bledsoe");
PersonStatic::set_email("example@gmail.com");
PersonStatic::set_phone("(111) 111-1111");
PersonStatic::set_address($people[0]['address']);

PersonStatic::get_full_name();

?>
