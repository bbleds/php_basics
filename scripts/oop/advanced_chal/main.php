<?php 
require_once "../../ini.php";
require_once "class.Convertible.php";
require_once "class.Motorcycle.php";

//Main functionality for goals
$vehicle = new Vehicle(4,10);
$vehicle->drive();
$vehicle->accelerate();
$vehicle->accelerate();
$vehicle->accelerate();
$vehicle->brake();
$vehicle->brake();
$vehicle->brake();
$vehicle->honk();
$vehicle->get_gauge_levels();

print "\n";

$car = new Car(4,12);
$car->accelerate(50, 5);
$car->accelerate(50, 5);
$car->brake(100);
$car->open_hood();

print "\n";

$convertible = new Convertible(4,15);
$convertible->open_roof();
$convertible->accelerate(70);
$convertible->brake(40);
$convertible->accelerate(30);
$convertible->brake(60);
$convertible->close_roof();

print "\n";

$motorcycle = new Motorcycle(2,5,1);
$motorcycle->accelerate(30);
$motorcycle->wheelie();
$motorcycle->honk();
$motorcycle->brake(30);

?>
