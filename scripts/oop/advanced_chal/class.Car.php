<?php 
require_once "../../ini.php";
require_once "class.Vehicle.php";

class Car extends Vehicle
{
	public $doors = 4;
	public $windows = 4;
	public $seats = 5;
	
	/**
	 * Vehicle::open_hood()
	 *
	 * Prints message that hood has been opened
	 *
	 * @access public
	 *
	 * @return void
	 */ 
	public function open_hood(){
		print "opening hood.\n";
	}
	
	/**
	 * Vehicle::open_trunk()
	 *
	 * Prints message that trunk has been opened
	 *
	 * @access public
	 *
	 * @return void
	 */ 
	public function open_trunk(){
		print "opening trunk.\n";
	}
}

?>
