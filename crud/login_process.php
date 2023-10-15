<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);

$stmt->execute();
$stmt->store_result();
$stmt->bind_result($db_username, $db_password);

if ($stmt->num_rows === 1 && $stmt->fetch() && password_verify($password, $db_password)) {
    // Successful login, redirect to the show_data.php page
    header("Location: show_data.php");
    exit();
} else {
    echo "Login failed. Please check your credentials.";
}

$stmt->close();
$conn->close();
?>
