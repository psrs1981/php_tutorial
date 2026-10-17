<?php // Starts the main PHP script that loads and uses both classes.
require_once __DIR__ . "/12-school.php"; // Loads the School\User class file once from this folder.
require_once __DIR__ . "/12-store.php"; // Loads the Store\User class file once from this folder.

$student = new \School\User(); // Creates a School\User object using its fully qualified class name.
$customer = new \Store\User(); // Creates a Store\User object using its fully qualified class name.

echo $student->getRole() . "<br>"; // Calls the School user's method and displays Student.
echo $customer->getRole() . "<br>"; // Calls the Store user's method and displays Customer.
?>
