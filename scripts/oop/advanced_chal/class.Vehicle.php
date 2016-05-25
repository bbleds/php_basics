<?php 
require_once "../../ini.php";

/**
 * @author Ben Bledsoe
 * @copyright 2016, The A Group
 *
 * 
 */
 class Vehicle
 {
 		public $wheels;
 		public $fuel_tank;
 		public $headlights;
 		public $dash_gauges = array(
 			"fuel_level" => 100,
 			"engine_temperature" => 200,
 			"speed" => 0
 		);
 		
	/**
	 * Vehicle::__construct()
	 *
	 * Called on object instantiation, sets initial properties and prints default values in $dash_gauges array
	 *
	 * @access public
	 *
	 * @param int $wheels
	 * @param int $fuelTank
	 * @param int $headlights
	 *
	 * @return void
	 */
	public function __construct($wheels, $fuelTank, $headlights = 2){
		print "This vehicle has:\n $wheels wheels, a tank that can hold $fuelTank gallons, and $headlights headlights!\n\nCurrent dash gauge levels:\n ";
		$this->display_gauge_levels();
		$this->drive();
		
	}
 
	/**
	 * Vehicle::display_gauge_levels()
	 *
	 * Prints the current levels of all dash gauges
	 *
	 * @access public
	 *
	 * @return void
	 */ 
 	public function display_gauge_levels(){
 	foreach($this->dash_gauges as $key => $value){
 		print "$key: $value";
 		
 		switch ($key){
 			case "fuel_level":
 				print "%, ";
 				break;
 			case "engine_temperature":
 				print " degrees F, ";
 				break;
 			case "speed":
 				print " mph\n";
 		}
 	}	
 }

	/**
	 * Vehicle::drive()
	 *
	 * Displays message that vehicle is ready to drive
	 *
	 * @access public
	 *
	 * @return void
	 */ 
 	public function drive(){
 		print "\nReady to drive!\n";
 	}
 
}

$example = new Vehicle(2,20);

?>
