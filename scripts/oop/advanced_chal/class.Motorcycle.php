<?php 
require_once "../../ini.php";
require_once "class.Vehicle.php";

/**
 * @author Ben Bledsoe
 * @copyright 2016, The A Group
 *
 * 
 */
class Motorcycle extends Vehicle{
	
	public $seats = 1;
	
	/**
	 * Motorcycle::open_hood()
	 *
	 * Prints a fun wheelie message
	 *
	 * @access public
	 *
	 * @return void
	 */ 
	public function wheelie(){
		print "WooHoo!\n";
	}
	
}

?>
