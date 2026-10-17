<?php
$servername = "127.0.0.1:5887"; // Uses the same MySQL host and port as the connection example.
$username = "root"; // Sets the MySQL username.
$password = "root"; // Sets the MySQL password from the connection example.
$dbname = "student"; // Selects the database that contains the student table.

$conn = new mysqli($servername, $username, $password, $dbname); // Opens a MySQLi connection to the database.
if ($conn->connect_error) { // Checks whether the connection failed.
    die("Connection failed: " . $conn->connect_error); // Stops and displays the connection error.
} // Ends the connection check.

$studentName = "ponguru"; // Sets the name of the student record to delete.
$sql = "DELETE FROM student WHERE studentName = ? LIMIT 1"; // Deletes at most one row whose name matches the placeholder.
$stmt = $conn->prepare($sql); // Prepares the SQL statement so the name is bound safely.
if ($stmt === false) { // Checks whether MySQL could prepare the statement.
    die("Prepare failed: " . $conn->error); // Stops and displays the preparation error.
} // Ends the prepare check.

$stmt->bind_param("s", $studentName); // Binds the student name as a string to the placeholder.
if ($stmt->execute()) { // Executes the delete when this example file is run.
    if ($stmt->affected_rows > 0) { // Checks whether a matching row was deleted.
        echo "Student record deleted successfully."; // Displays a success message when a row was removed.
    } else { // Handles the case where no row matched the supplied name.
        echo "No student record named ponguru was found."; // Displays a message when nothing was deleted.
    } // Ends the affected-row check.
} else { // Handles an error from the delete statement.
    echo "Delete failed: " . $stmt->error; // Displays the statement error.
} // Ends the delete result check.

$stmt->close(); // Releases the prepared statement resources.
$conn->close(); // Closes the database connection.
?>
