<?php // Starts PHP code so the server runs this example.
$host = "127.0.0.1"; // Sets the MySQL server address used by the mysqli example.
$port = 5887; // Sets the MySQL port used by the mysqli example.
$dbname = "student"; // Selects the student database.
$username = "root"; // Sets the MySQL username used by the mysqli example.
$password = "root"; // Sets the MySQL password used by the mysqli example.

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4"; // Builds the PDO connection string with the host, port, database, and character set.

try { // Starts a block that can catch database connection or query errors.
    $connection = new PDO($dsn, $username, $password); // Opens a PDO connection to the MySQL database.
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Makes PDO throw an exception if a database operation fails.

    $sql = "CREATE TABLE IF NOT EXISTS MyGuests1 (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )"; // Defines the same MyGuests table as the mysqli example and avoids an error if it already exists.

    $connection->exec($sql); // Runs the CREATE TABLE statement; exec() is used because it returns no rows.
    echo "Table created successfully or already exists."; // Displays a success message after the statement runs.
} catch (PDOException $error) { // Runs if PDO cannot connect or the SQL statement fails.
    die("Database error: " . $error->getMessage()); // Displays the database error and stops the script.
} // Ends the try/catch block.
?>
