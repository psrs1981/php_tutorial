<?php // Starts PHP code so the server runs the example below.
class Calculator { // Defines a Calculator class that can perform addition.
    public function __call($methodName, $arguments) { // PHP runs this magic method when an undefined or inaccessible instance method is called.
        // $methodName contains the name of the method that the code tried to call.
        // $arguments contains the values passed to that method, stored in an array.
        if ($methodName === "add") { // Checks that the requested method name is exactly "add".
            return array_sum($arguments); // Adds all the numbers in the arguments array and returns the total.
        } // Ends the check for the supported "add" method.

        throw new BadMethodCallException("Unknown method: " . $methodName); // Stops with an error if a different missing method was called.
    } // Ends the __call magic method.
} // Ends the Calculator class definition.

$calculator = new Calculator(); // Creates a Calculator object and stores it in the $calculator variable.
echo "Add 2 numbers: " . $calculator->add(2, 3) . "<br>"; // Supplies two arguments to add; __call sums them and displays 5.
echo "Add 3 numbers: " . $calculator->add(2, 3, 4) . "<br>"; // Supplies three arguments to add; __call sums them and displays 9.
echo "Add several numbers: " . $calculator->add(2, 3, 4, 5, 6) . "<br>"; // Supplies five arguments to add; __call sums them and displays 20.

// PHP does not allow defining multiple methods with the same name and different parameter lists.
// Here, __call handles an undefined method dynamically; this is often used to demonstrate method overloading in PHP.
?>
