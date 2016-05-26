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
	 * @param int|float $fuelTank
	 * @param int $headlights
	 *
	 * @return void
	 */
	public function __construct($wheels, $fuelTank, $headlights = 2){
		$this->wheels = $wheels;
		$this->fuel_tank = $fuelTank;
		$this->headlights = $headlights;
		print "This vehicle has:\n $wheels wheels, a tank that can hold $fuelTank gallons, and $headlights headlights!\n\nCurrent dash gauge levels:\n ";
		$this->get_gauge_levels();
		$this->drive();
	}
	
	/**
	 * Vehicle::__destruct()
	 *
	 * Calls Vehicle::get_gauge_levels() after final reference to object 
	 *
	 * @access public
	 *
	 * @return void
	 */ 
	 public function __destruct(){
	 	$this->get_gauge_levels();	
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
	 * Accelerates vehicle, updates values in dash_gauges array
	 *
	 * @access public
	 *
	 * @param int $speed
	 * @param int|float $fuelTaken
	 * @param int|float $tempIncrease
	 *
	 * @return void
	 */ 
	 public function accelerate($speed = 10, $fuelTaken = 1, $tempIncrease = .5){
	 		print "\nGo faster!\n";
	 		if($this->dash_gauges['fuel_level'] - (($fuelTaken/$this->fuel_tank)*100) <= 0){
	 			die("OUT OF FUEL!");
	 		} else {
	 			$this->dash_gauges['speed'] += $speed;
	 			$this->dash_gauges['fuel_level'] -= (($fuelTaken/$this->fuel_tank)*100);
	 			$this->dash_gauges['engine_temperature'] += $tempIncrease;
	 		}
	 }
	 
	/**
	 * Vehicle::brake()
	 *
	 * Slows vehicle down, updates various values in dash_gauges array appropriately 
	 *
	 * @access public
	 *
	 * @return void
	 */ 
	 public function brake($speedDecrease = 10, $tempDecrease = .1){
	 	print "Slow down!\n";
	 	$this->dash_gauges['speed'] -= $speedDecrease;
	 	$this->dash_gauges['engine_temperature'] -= $tempDecrease;
	 }
	 
	/**
	 * Vehicle::honk()
	 *
	 * Honks the vehicle to annoy other drivers
	 *
	 * @access public
	 *
	 * @return void
	 */ 
	 public function honk(){
	 	print "HONK!\n";
	 }

}

$example = new Vehicle(2,20);
$example->accelerate();
$example->get_gauge_levels();

$example->brake();
$example->get_gauge_levels();

$example->honk();

?>
