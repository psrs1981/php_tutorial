<?php // Starts PHP code so the server runs the class definition below.
namespace Store; // Places this class in the Store namespace to avoid name conflicts.

class User { // Defines the Store\User class, which can share the short name User with School\User.
    public function getRole() { // Defines the same method name used by the School\User class.
        return "Customer"; // Returns Customer for a user from the Store namespace.
    } // Ends the getRole method.
} // Ends the Store\User class.
