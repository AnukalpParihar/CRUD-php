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

// Check if the form is submitted
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $dob = $_POST['dob'];

    // SQL query to update user data
    $sql = "UPDATE users SET name='$name', username='$username', dob='$dob' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: show_data.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve user data for the specified ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: show_data.php");
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h2>Update User</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
        <label for="username">User ID:</label>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>">
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>">
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
