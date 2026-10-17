<?php // Opens PHP code so the server runs the example below.
class Person { // Defines a Person class, which is a blueprint for person objects.
	public $name = "Ava"; // Public: this property can be read or changed both inside and outside the class.
	private $age = 20; // Private: this property can only be read or changed inside this Person class.
	protected $city = "London"; // Protected: this property can be used inside this class and its child classes.

	public function introduce() { // Defines a public method that can be called from outside the class.
		echo "Name: " . $this->name . "<br>"; // $this refers to this object, so the method can read its public name.
		echo "Age: " . $this->age . "<br>"; // The class can read its own private age property.
		echo "City: " . $this->city . "<br>"; // The class can read its own protected city property.
	} // Ends the introduce method.
} // Ends the Person class definition.

$person = new Person(); // Creates a Person object and stores it in the $person variable.
echo $person->name . "<br>"; // Works because name is public and can be accessed outside the class.
// echo $person->age; // Would cause an error because age is private and this line is outside the class.
// echo $person->city; // Would cause an error because city is protected and this line is outside the class.
$person->introduce(); // Calls the public method, which can display all three properties.
?>
