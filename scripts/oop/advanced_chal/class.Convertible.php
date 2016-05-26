<?php 
require_once "../../ini.php";
require_once "class.Car.php";

/**
 * @author Ben Bledsoe
 * @copyright 2016, The A Group
 *
 * 
 */
 class Convertible extends Car {
 
	/**
	 * Convertible::open_roof()
	 *
	 * Prints message that roof has been opened
	 *
	 * @access public
	 *
	 * @return void
	 */ 
 	public function open_roof(){
 		print "Opening roof.\n";	
 	}

	/**
	 * Convertible::close_roof()
	 *
	 * Prints message that roof has been closed
	 *
	 * @access public
	 *
	 * @return void
	 */  	
 	public function close_roof(){
 		print "Closing roof.\n";
 	}
 }
 
?>
