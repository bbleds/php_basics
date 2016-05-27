<?php 
require_once '../../ini.php';
require_once 'class.Car.php';


/**
 * @author Ben Bledsoe
 * @copyright 2016, The A Group
 *
 * BigRig
 *
 * Provides properties and methods specific to Big Rigs.  
 * Extends Car class, because a Big Rig is basically a large type of car, it has many of the same attributes and methods (differences between Car and BigRig have been overridden in BigRig).  
 *
 */
class BigRig extends Car 
{
	public $haul;
	
	/**
	 * BigRig::__construct()
	 *
	 * Called on object instantiation, extends parent::__construct() and set initial properties
	 *
	 * @access public
	 *
	 * @param string $haul
	 * @param int $wheels
	 * @param int|float $fuelTank
	 * @param int $headlights
	 *
	 * @return void
	 */
	public function __construct($haul,$wheels, $fuelTank, $headlights=2){
		$this->attach_trailer();
		parent::__construct($wheels,$fuelTank,$headlights);
		$this->haul = $haul;	
	}
	
	/**
	 * BigRig::attach_trailer()
	 *
	 * Outputs ready message
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function attach_trailer(){
		print "Trailer attached and ready to hit the road!\n";	
	}
	
	/**
	 * BigRig::open_trunk()
	 *
	 * Overrides Car::open_trunk(), prints a message concerning $haul
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function open_trunk(){
		print "Opening trailer to unload the $this->haul!";
	}
	
}

$rig = new BigRig('corvettes',18,50);
$rig->accelerate(60);
$rig->brake(60);
$rig->open_trunk();

?>
