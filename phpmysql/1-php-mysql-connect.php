<?php
// step 1: declaring the connectionstring secrets
$servername = "127.0.0.1:5887";
$username = "root";
$password = "root";
$dbname = "student";

// step 2: Create connection
// using the mysqli object-oriented approach
// new mysqli(servername, username, password, dbname)
// returns a connection object
// which we store in $conn
// This object will be used for all subsequent database operations.
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// step 3: Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// step 4: to write sql - for any opertaion
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
// step 5: execute the sql query and handle the result
// Execute the prepare statement using the query method of the connection object
if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
// step 6: handle any additional logic if needed
//operation on the data
//step 7: close the connection
$conn->close();
?>