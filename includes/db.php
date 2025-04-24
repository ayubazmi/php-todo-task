<?php
// Database connection settings
$servername = getenv('DB_HOST');  // Use environment variable 'DB_HOST'
$username = getenv('DB_USER');    // Use environment variable 'DB_USER'
$password = getenv('DB_PASSWORD'); // Use environment variable 'DB_PASSWORD'
$dbname = getenv('DB_NAME');      // Use environment variable 'DB_NAME'

// Create a new MySQLi object to establish a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there is a connection error, output the error message and terminate the script
    die("Connection failed: " . $conn->connect_error);
}
?>
