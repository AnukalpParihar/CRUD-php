<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "users";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an HTML table
$html = '<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>User ID</th>
        <th>Date of Birth</th>
        <th>Action</th>
    </tr>';

// SQL query to retrieve all data from the "users" table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any registered users
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add data for each user to the HTML table
        $html .= '<tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["name"] . '</td>
            <td>' . $row["username"] . '</td>
            <td>' . $row["dob"] . '</td>
            <td>
                <a href="update_user.php?id=' . $row["id"] . '">Update</a> |
                <a href="delete_user.php?id=' . $row["id"] . '">Delete</a>
            </td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="5">No registered users found.</td></tr>';
}

// Close the HTML table
$html .= '</table';

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registered Users</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h2>Registered Users</h2>
    <?php echo $html; ?>

    <div class="back-button">
        <a href="registration_form.php">Back to Registration Page</a>
    </div>
</body>
</html>
