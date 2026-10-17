<?php // Starts PHP code so the server runs the example below.
abstract class Animal { // Defines an abstract parent class that cannot be instantiated directly.
    abstract public function makeSound(); // Requires every concrete child class to provide this method.
} // Ends the abstract Animal class.

class Dog extends Animal { // Defines Dog as a child class of Animal.
    public function makeSound() { // Implements the abstract method declared by Animal.
        echo "The dog says: Woof!<br>"; // Displays the sound made by this Dog object.
    } // Ends the makeSound method.
} // Ends the Dog child class.

class Cat extends Animal {
    public function makeSound() { // Implements the abstract method declared by Animal.
        echo "The cat says: Meow!<br>"; // Displays the sound made by this Cat object.
    } // Ends the makeSound method.
}
// $animal = new Animal(); // Uncommenting this line causes an error because Animal is abstract.
// $dog = new Dog(); // Creates a Dog object; a concrete child class can be instantiated.
// $dog->makeSound(); // Calls Dog's implementation of the method required by Animal.
$dog = new Dog(); // Creates a Dog object; a concrete child class can be instantiated.
$dog->makeSound(); // Calls Dog's implementation of the method required by Animal.

$cat = new Cat(); // Creates a Cat object; a concrete child class can be instantiated.
$cat->makeSound(); // Calls Cat's implementation of the method required by Animal.

// An abstract class is a base class that provides a shared starting point for child classes.
// You cannot create an object directly from an abstract class, so new Animal() is not allowed.
// An abstract method declares what a child class must do, but does not contain the method's code.
// Every non-abstract child class must provide code for the abstract methods it inherits.
// Here, Dog provides the makeSound method required by Animal, so a Dog object can be created.
?>
