<?php // Starts PHP code so the server runs the example below.
class Animal { // Defines one parent class that child classes can extend.
    public function eat() { // Defines a method that child classes inherit from Animal.
        echo "The duck is eating.<br>"; // Displays a message when the inherited method runs.
    } // Ends the eat method.
} // Ends the Animal parent class.

interface CanWalk { // Defines a behavior contract for things that can walk.
    public function walk(); // Requires every class using this interface to define walk().
} // Ends the CanWalk interface.

interface CanSwim { // Defines a separate behavior contract for things that can swim.
    public function swim(); // Requires every class using this interface to define swim().
} // Ends the CanSwim interface.

class Duck extends Animal implements CanWalk, CanSwim { // Extends one class and implements two interfaces.
    public function walk() { // Provides the walk method required by CanWalk.
        echo "The duck is walking.<br>"; // Displays a message to show the duck can walk.
    } // Ends the walk method.

    public function swim() { // Provides the swim method required by CanSwim.
        echo "The duck is swimming.<br>"; // Displays a message to show the duck can swim.
    } // Ends the swim method.
} // Ends the Duck class.

$duck = new Duck(); // Creates a Duck object that inherits from Animal and follows both interfaces.
$duck->eat(); // Calls the method inherited from the Animal parent class.
$duck->walk(); // Calls the method required by CanWalk and implemented by Duck.
$duck->swim(); // Calls the method required by CanSwim and implemented by Duck.

// PHP does not allow a class to extend multiple parent classes.
// Instead, a class can extend one parent class and implement multiple interfaces, as Duck does here.
?>
