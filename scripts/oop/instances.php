<?php
require_once "../../ini.php";
require_once "./classes.php";

$recipe1 = new Recipe("a first example");

$recipe2 = new Recipe("a simple example");

print $recipe2->displayRecipe();

print $recipe2;
?>
