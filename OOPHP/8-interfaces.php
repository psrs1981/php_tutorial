<?php // Starts PHP code so the server runs the example below.
interface Greeter { // Defines an interface that lists behavior a class must provide.
    public function greet(); // Requires any class implementing Greeter to define a greet method.
} // Ends the Greeter interface.

class Student implements Greeter { // Declares that Student agrees to follow the Greeter interface.
    public function greet() { // Provides the required implementation of the greet method.
        echo "Hello! I am a student.<br>"; // Displays the greeting when the method is called.
    } // Ends the greet method.
} // Ends the Student class.

$student = new Student(); // Creates a Student object that follows the Greeter interface.
$student->greet(); // Calls the greeting behavior implemented by Student.
?>
