<?php 
require_once "./classes.php";

$recipe1 = new Recipe();

$recipe2 = new Recipe();

$recipe2->setTitle("a simple example");

print $recipe2->displayRecipe();
?>
