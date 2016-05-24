<?php 

require_once "../../ini.php";

class Recipe 
{
	public $title;
	public $ingredients = array();
	public $instructions = array();
	public $yield;
	public $tag = array();
	public $source = 'treehouse';
}

$recipe1 = new Recipe();
print $recipe1->source;

print_r($recipe1);
?>
