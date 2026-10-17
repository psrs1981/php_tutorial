<?php
$servername = "127.0.0.1:5887"; // Uses the same MySQL host and port as the connection example.
$username = "root"; // Sets the MySQL username.
$password = "root"; // Sets the MySQL password from the connection example.
$dbname = "student"; // Selects the database that contains the student table.

$conn = new mysqli($servername, $username, $password, $dbname); // Opens a MySQLi connection to the database.
if ($conn->connect_error) { // Checks whether the connection failed.
    die("Connection failed: " . $conn->connect_error); // Stops and displays the connection error.
} // Ends the connection check.

class Student { // Defines a class responsible for retrieving student records.
    private $connection; // Stores the database connection for this Student object.

    public function __construct($connection) { // Receives the database connection when a Student object is created.
        $this->connection = $connection; // Saves the connection so this object's methods can use it.
    } // Ends the constructor.

    public function fetchAllRecords() { // Defines a method that fetches every student record.
        $sql = "SELECT student_id, studentName, studentAge, studentGender FROM student"; // Selects the student columns to return.
        $result = $this->connection->query($sql); // Runs the query using this object's database connection.

        if ($result === false) { // Checks whether MySQL reported an error for the query.
            die("Query failed: " . $this->connection->error); // Stops and displays the query error.
        } // Ends the query check.

        return $result; // Returns the database result to the code that called this method.
    } // Ends the fetchAllRecords method.
} // Ends the Student class.

$student = new Student($conn); // Creates a Student object and gives it the database connection.
$result = $student->fetchAllRecords(); // Calls the Student object's method to retrieve all records.

if ($result->num_rows > 0) { // Checks whether the query returned at least one student.
    echo "<table border='1'>"; // Starts a simple HTML table for displaying the records.
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th></tr>"; // Displays a heading for each selected column.

    while ($row = $result->fetch_assoc()) { // Reads each database row as an associative array.
        echo "<tr>"; // Starts a table row for this student.
        echo "<td>" . htmlspecialchars((string) $row["student_id"], ENT_QUOTES, "UTF-8") . "</td>"; // Safely displays the student's ID.
        echo "<td>" . htmlspecialchars($row["studentName"], ENT_QUOTES, "UTF-8") . "</td>"; // Safely displays the student's name.
        echo "<td>" . htmlspecialchars((string) $row["studentAge"], ENT_QUOTES, "UTF-8") . "</td>"; // Safely displays the student's age.
        echo "<td>" . htmlspecialchars($row["studentGender"], ENT_QUOTES, "UTF-8") . "</td>"; // Safely displays the student's gender.
        echo "</tr>"; // Ends this student's table row.
    } // Ends the loop after every returned row has been displayed.

    echo "</table>"; // Ends the HTML table.
} else { // Runs when the student table has no records.
    echo "No student records found."; // Displays a message instead of an empty table.
} // Ends the record-count check.

$result->free(); // Releases the memory used by the query result.
$conn->close(); // Closes the database connection.
?>
