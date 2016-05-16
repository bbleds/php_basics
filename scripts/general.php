<?php
  // string manipulation
    $str = "The quick brown fox jumps over the lazy dog";
    echo "the string is: $str <br /><br />";
    // split
      $splitArray = explode(" ", $str);
      echo "the string split at space characters is - ";
      var_dump($splitArray);
      echo "<br /><br />";
    // join
      echo "the string joined without space characters is - ";
      var_dump(implode("", $splitArray));
      echo "<br /><br />";
  // array manipulation
      echo "chunk array into groups of three - ";
      var_dump(array_chunk($splitArray, 3));
      echo "<br /><br />";

  // loops
    // for loop
      echo "loop over each item in array and print out value- <br />";
      for($i = 0; $i < count($splitArray); $i++){
        echo "$splitArray[$i] <br />";
      }
      echo "<br /><br />";
    // for each loop
      foreach ($splitArray as $word){
        echo "the word is -  $word <br />";
      }
      echo "<br /><br />";
    // while loop
      $i = 0;
      while ($i < 10){
        echo "i is currently - $i <br />";
        $i++;
      }
      echo "<br /><br />";


  // classes
    // create a class
      class Animal
      {

        protected $description = "a living animal";

        public function getDescr(){
          echo "This is  - $this->description <br />";
        }
      }
    // instantiate
      $someAnimal = new Animal();
      $someAnimal->getDescr();
    // extend class
      class Dog extends Animal
      {
        protected $description = "a living animal that is a dog";
      }
      $dog = new Dog();
      $dog->getDescr();


?>
