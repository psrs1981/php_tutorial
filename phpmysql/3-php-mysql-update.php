<?php
$servername = "127.0.0.1:5887"; // Uses the same MySQL host and port as the connection example.
$username = "root"; // Sets the MySQL username.
$password = "root"; // Sets the MySQL password from the connection example.
$dbname = "student"; // Selects the database that contains the student table.

$conn = new mysqli($servername, $username, $password, $dbname); // Opens a MySQLi connection to the database.
if ($conn->connect_error) { // Checks whether the connection failed.
    die("Connection failed: " . $conn->connect_error); // Stops and displays the connection error.
} // Ends the connection check.

$oldStudentName = "srihari ponguru"; // Sets the current name to search for.
$newStudentName = "srihari ravi ponguru"; // Sets the replacement name to save.

$sql = "UPDATE student SET studentName = ? WHERE studentName = ?"; // Changes the name for rows that match the old name.
$stmt = $conn->prepare($sql); // Prepares the SQL statement so values can be bound safely.
if ($stmt === false) { // Checks whether MySQL could prepare the statement.
    die("Prepare failed: " . $conn->error); // Stops and displays the preparation error.
} // Ends the prepare check.

$stmt->bind_param("ss", $newStudentName, $oldStudentName); // Binds the new name first, then the name used to find matching rows.
if ($stmt->execute()) { // Executes the update when this example file is run.
    if ($stmt->affected_rows > 0) { // Checks whether one or more rows were changed.
        echo $stmt->affected_rows . " student record(s) updated."; // Displays the number of rows whose name changed.
    } else { // Handles the case where no matching row was changed.
        echo "No student record named ponguru was changed."; // Explains that no row matched or the value was already the same.
    } // Ends the affected-row check.
} else { // Handles an error from the update statement.
    echo "Update failed: " . $stmt->error; // Displays the statement error.
} // Ends the update result check.

$stmt->close(); // Releases the prepared statement resources.
$conn->close(); // Closes the database connection.
?>
