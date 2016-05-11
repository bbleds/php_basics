<?php

// variable to pass
$name = "Person";

// constant to pass
define('FAV_COLOR', 'Red');

// heredoc syntax
$myString = <<< EOT
  this is a simple stanza in PHP using heredoc syntax, thanks $name.
EOT;
echo $myString;
echo " My Favorite color is " . FAV_COLOR . "<br />";

// split string
$splitString = explode(" ", $myString);
var_dump($splitString);


// join array to string
$joinedString = implode(" ", $splitString);
echo "<br />".$joinedString;




?>
