<?php
require_once "../../ini.php";
require_once "./classes.php";

$recipe1 = new Recipe("a first example");

$recipe2 = new Recipe("a simple example");

//print $recipe2->displayRecipe();

//print $recipe2;

$objects = array();

$objects[] = new Recipe("recipe one");
$objects[] = new Recipe("recipe two");

foreach($objects as $object){
	print $object->getTitle() . "\n";
}


class TestOne 
{
	public $title = "The first test \n";	
}

class TestTwo extends TestOne
{
	public $title = "The second test \n";	
	public $example = "an example";
	public function exampleFunc(){
		print "Hey hey hey hey";	
	}
}

class TestThree extends TestTwo
{
	public $title = "The third test \n";	
	public function getThis(){
		parent::exampleFunc();	
	}
	
	public function __destruct(){
		print "\n$this->title is being destroyed";	
	}
}

$objectOne = new TestOne();
$objectTwo = new TestTwo();
$objectThree = new TestThree();

print $objectOne->title;
print $objectTwo->title;
print $objectThree->title;
$objectThree->getThis();

?>
