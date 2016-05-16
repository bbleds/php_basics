<?php

$result = (string)(5*10);
echo "The result is " . $result . "<br />";

if($result > 50){
  echo "Greater than 50 <br />";
} else {
  echo "it is 50 or below <br />";
}


for($i = 0; $i < 10; $i++ ){
  echo "i is currently " . $i . "<br />";
};

function hello($fName, $lName){
  echo "Hello, $fName $lName!";
}

hello("John", "Doe");


$example = function($arg1){
  echo $arg1;
};

$example("hello");

?>
