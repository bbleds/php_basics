<?php
require_once "../../ini.php";
require_once "./classes.php";

$recipe1 = new Recipe("a first example");

$recipe2 = new Recipe("a simple example");

$objects = array();

$objects[] = new Recipe("recipe one");
$objects[] = new Recipe("recipe two");

foreach($objects as $object){
	print $object->getTitle() . "\n";
}
?>
