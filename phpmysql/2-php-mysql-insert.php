<?php
$servername = "127.0.0.1:5887"; // Uses the same MySQL host and port as the connection example.
$username = "root"; // Sets the MySQL username.
$password = "root"; // Sets the MySQL password from the connection example.
$dbname = "student"; // Selects the database that contains the student table.

$conn = new mysqli($servername, $username, $password, $dbname); // Opens a MySQLi connection to the database.
if ($conn->connect_error) { // Checks whether the connection failed.
    die("Connection failed: " . $conn->connect_error); // Stops and displays the connection error.
} // Ends the connection check.

$studentName = "jitendra"; // Stores the example student's name.
$studentAge = 21; // Stores the example student's age as an integer.
$studentGender = "Male"; // Stores the example student's gender.

$sql = "INSERT INTO student (studentName, studentAge, studentGender) VALUES (?, ?, ?)"; // Uses placeholders instead of placing values directly in SQL.
$stmt = $conn->prepare($sql); // Prepares the SQL statement for safe parameter binding.
if ($stmt === false) { // Checks whether MySQL could prepare the statement.
    die("Prepare failed: " . $conn->error); // Stops and displays the preparation error.
} // Ends the prepare check.

$stmt->bind_param("sis", $studentName, $studentAge, $studentGender); // Binds string, integer, and string values to the placeholders.
if ($stmt->execute()) { // Executes the insert when this example file is run.
    echo "Student record inserted successfully."; // Displays a message if the row was inserted.
} else { // Handles an error from the insert statement.
    echo "Insert failed: " . $stmt->error; // Displays the statement error.
} // Ends the insert result check.

$stmt->close(); // Releases the prepared statement resources.
$conn->close(); // Closes the database connection.
?>
