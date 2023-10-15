<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "users";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security
$dob = $_POST['dob'];

// Prepare an SQL statement using a prepared statement
$stmt = $conn->prepare("INSERT INTO users (name, username, password, dob) VALUES (?, ?, ?, ?)");

// Bind parameters to the statement
$stmt->bind_param("ssss", $name, $username, $password, $dob);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration successful! Data has been sent to the database.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
