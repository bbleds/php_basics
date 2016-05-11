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


















?>
