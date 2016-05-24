<?php 

require_once "../../ini.php";

class Recipe 
{
	private $title;
	public $ingredients = array();
	public $instructions = array();
	public $yield;
	public $tag = array();
	public $source = 'treehouse';

	public function addIngredients($item, $amount = null, $measure = null)
	{
		$this->ingredients[] = array(
			'item' => $item,
			'amount' => $amount,
			'measure' => $measure
		);
	}

	public function displayRecipe()
	{
		return $this->title . " by " . $this->source;
	}

	public function setTitle($title)
	{
		$this->title = ucwords($title);
	}

	public function getTitle()
	{
		return $this->title;
	}
}

?>
