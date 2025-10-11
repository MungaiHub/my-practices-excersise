<?php
// registration.php

// Database connection
$host = 'localhost';
$db = 'monkeybay';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set
    if (isset($_POST['email'], $_POST['username'], $_POST['password'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Prepare and execute the insert statement
        $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $username, $password);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: index.html"); // Change to the path of your login page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}
$conn->close();
?>



