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
 		public $tank_capacity;
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
		$this->wheels = $wheels;
		$this->fuel_tank = $fuelTank;
		$this->tank_capacity = $fuelTank;
		$this->headlights = $headlights;
		print "This vehicle has:\n $wheels wheels, a tank that can hold $fuelTank gallons, and $headlights headlights!\n\nCurrent dash gauge levels:\n ";
		$this->get_gauge_levels();
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
 	public function get_gauge_levels(){
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
 	
	/**
	 * Vehicle::accelerate()
	 *
	 * Displays message that vehicle is ready to drive
	 *
	 * @access public
	 *
	 * @return void
	 */ 
	 public function accelerate($speed = 10, $fuelTaken = 1, $tempIncrease = .5){
	 		print "\nGo faster!\n";
	 		if($this->fuel_tank - $fuelTaken <= 0){
	 			die("OUT OF FUEL!");
	 		} else {
	 			$this->dash_gauges['speed'] += $speed;
	 			$this->fuel_tank -= $fuelTaken;
	 			$this->dash_gauges['fuel_level'] = (($this->fuel_tank/$this->tank_capacity)*100);
	 			$this->dash_gauges['engine_temperature'] += $tempIncrease;	
	 		}
	 }
	 	
 
}

$example = new Vehicle(2,20);
$example->accelerate();
$example->get_gauge_levels();

?>
