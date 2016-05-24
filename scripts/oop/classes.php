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

	public function displayRecipe()
	{
		return $this->title . " by " . $this->source;
	}
}

$recipe1 = new Recipe();

$recipe2 = new Recipe();

$recipe2->title = "An example";

print $recipe2->displayRecipe();
?>
