<?php // Starts PHP code so the server runs the example below.
trait Logger { // Defines a trait containing a method that classes can reuse.
    public function logMessage($message) { // Defines a public method and accepts a message as an argument.
        echo "Log: " . $message . "<br>"; // Displays the word Log followed by the supplied message.
    } // Ends the logMessage method.
} // Ends the Logger trait.

class UserService { // Defines a class that handles a simple user-related task.
    use Logger; // Adds the Logger trait's methods to this class.

    public function createUser() { // Defines a method that represents creating a user.
        $this->logMessage("A user was created."); // Calls the method provided by the Logger trait.
    } // Ends the createUser method.
} // Ends the UserService class.

$userService = new UserService(); // Creates a UserService object that includes the Logger trait's method.
$userService->createUser(); // Creates the example user action and displays its log message.

// A trait is a way to reuse methods in classes; it is not a class that you instantiate directly.
?>
