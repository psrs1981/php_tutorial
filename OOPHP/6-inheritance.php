<?php // Starts PHP code so the server runs the example below.
class Animal { // Defines a parent class with behavior that other classes can inherit.
    public function eat() { // Defines a public method that can be called outside the class.
        echo "The animal is eating.<br>"; // Displays a message when the eat method is called.
    } // Ends the eat method.
} // Ends the Animal parent class.

class Dog extends Animal { // Defines Dog as a child class that inherits Animal's public methods.
    public function bark() { // Adds a method that belongs specifically to the Dog class.
        echo "The dog is barking.<br>"; // Displays a message when the bark method is called.
    } // Ends the bark method.
} // Ends the Dog child class.

$dog = new Dog(); // Creates a Dog object and stores it in the $dog variable.
$dog->eat(); // Calls the inherited eat method from the Animal parent class.
$dog->bark(); // Calls the bark method defined in the Dog child class.
?>
