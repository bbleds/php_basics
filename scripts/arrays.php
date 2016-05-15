<?php

// Create an array and dump it
$myArray = array("abcdefg", "b", "c");
echo "The contents of the array: <br />";
var_dump($myArray);
echo "<br /> <br />";

// ================== splitting and joining
echo "Splitting and Joining <br />";

// alternate array snytax
echo "Array to chunk: <br />";
$arrayToSplit = ["a", "b", 1, 4, 6, 8, "Hello"];
var_dump($arrayToSplit);
echo "<br />";

// split array into chunks of 2
echo "Chunked array : <br />";
$arrayTwo = array_chunk($arrayToSplit, 2);
var_dump($arrayTwo);
echo "<br />";

// merge first two chunks of array back together
echo "Merged array : <br />";
$merged = array_merge($arrayTwo[0], $arrayTwo[1]);
var_dump($merged);
echo "<br />";


// Split string into an array by the space character and join back into a string
$theString = "Hello world, It's a great day!";
//============== in multiple statements
$splitString = explode(" ", $theString);
echo "it has been split: <br />";
var_dump($splitString);
echo "<br />";

// loop over each and echo out
foreach($splitString as $value){
  echo $value . "<br />";
}

// join split array together
$joinedString = implode(" ", $splitString);
echo $joinedString;
echo "<br />";

// ============== in one statement and elimate spaces
echo "<br />";
echo implode("", explode(" ", $theString));
?>
