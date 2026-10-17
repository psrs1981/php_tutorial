<?php
$servername = "127.0.0.1:5887"; // Uses the same MySQL host and port as the other examples.
$username = "root"; // Sets the MySQL username.
$password = "root"; // Sets the MySQL password from the connection example.
$dbname = "student"; // Selects the database containing the three related tables.

$conn = new mysqli($servername, $username, $password, $dbname); // Opens a MySQLi connection to the database.
if ($conn->connect_error) { // Checks whether the connection failed.
    die("Connection failed: " . $conn->connect_error); // Stops and displays the connection error.
} // Ends the connection check.

$sql = "SELECT student.studentName, subjects.subject_name AS course_name
        FROM student
        INNER JOIN student_subject
            ON student.student_id = student_subject.student_id
        INNER JOIN subjects
            ON student_subject.subject_id = subjects.subject_id
        ORDER BY student.studentName, subjects.subject_name"; // Joins the related tables; change subject_name if your subjects table uses another name column.

$result = $conn->query($sql); // Runs the query and stores the matching student-course rows.
if ($result === false) { // Checks whether MySQL reported an error for the query.
    die("Query failed: " . $conn->error); // Stops and displays the query error.
} // Ends the query check.

if ($result->num_rows > 0) { // Checks whether the joins found any matching records.
    echo "<table border='1'>"; // Starts a simple HTML table for the results.
    echo "<tr><th>Student Name</th><th>Course Name</th></tr>"; // Displays headings for the two requested values.

    while ($row = $result->fetch_assoc()) { // Reads each joined row as an associative array.
        echo "<tr>"; // Starts one row in the results table.
        echo "<td>" . htmlspecialchars($row["studentName"], ENT_QUOTES, "UTF-8") . "</td>"; // Safely displays the student's name.
        echo "<td>" . htmlspecialchars($row["course_name"], ENT_QUOTES, "UTF-8") . "</td>"; // Safely displays the subject as the course name.
        echo "</tr>"; // Ends the current results row.
    } // Ends the loop after all matching rows have been displayed.

    echo "</table>"; // Ends the HTML table.
} else { // Runs when there are no matching student-subject relationships.
    echo "No student-course records found."; // Displays a message instead of an empty table.
} // Ends the result-count check.

$result->free(); // Releases the memory used by the query result.
$conn->close(); // Closes the database connection.
?>
