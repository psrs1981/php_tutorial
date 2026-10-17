<?php // Starts PHP code so the server runs the example below.
class Website { // Defines a class whose static members can be used without making an object.
    public static $name = "Learning PHP"; // Declares a static property that belongs to the class, not to one object.

    public static function showName() { // Declares a static method that can be called using the class name.
        echo self::$name . "<br>"; // Uses self:: to access this class's static name property.
    } // Ends the showName method.
} // Ends the Website class.

Website::showName(); // Calls the static method with ::, so no Website object is needed.
echo Website::$name . "<br>"; // Reads the public static property directly through the class name.

// In PHP, static is used on class properties and methods; there is no static class keyword.
// Static members belong to the class and are accessed with ClassName::memberName.
// Calling Website::showName() does not create a Website object; a static method has no $this object.
// A static property is shared at the class level, but this does not make Website a singleton.
// You can still create multiple separate Website objects by calling new Website() multiple times.
?>
