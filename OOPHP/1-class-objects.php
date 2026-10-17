<?php // Opens PHP code so the server knows to run the code below.
class Fruit { // Defines a class, which is a blueprint for creating fruit objects.
  public $name; // Declares a property that can be accessed inside or outside this class.
  public $color; // Declares another publicly accessible property for the fruit's color.

  function set_details($name, $color) { // Defines a method that receives a name and a color.
    $this->name = $name; // Stores the given name in this object's name property; $this means this object.
    $this->color = $color; // Stores the given color in this object's color property.
  } // Ends the set_details method.

  function get_details() { // Defines a method that displays this object's saved details.
    echo "Name: " . $this->name . ". Color: " . $this->color .".<br>"; // Joins text and property values, then prints them; <br> starts a new browser line.
  } // Ends the get_details method.
} // Ends the Fruit class definition.
$apple = new Fruit(); // Creates a Fruit object and stores it in the $apple variable.
$apple->set_details("Apple", "Red"); // Calls the object's method to save its name and color.
$apple->get_details(); // Calls the object's method to display its saved details.

$banana = new Fruit(); // Creates a second, separate Fruit object in the $banana variable.
$banana->set_details("Banana", "Yellow"); // Saves a different name and color in the banana object.
$banana->get_details(); // Displays the banana object's saved details.
// $dummy = 1;
$apple = new Fruit();
var_dump($apple instanceof Fruit);

?>