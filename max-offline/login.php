<?php
// login.php

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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to fetch the password hash for the given username
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Check if the user exists and if the password is correct
    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        // Redirect to the next page (index.html) upon successful login
        header("Location: index.html");
        exit(); // Make sure to stop the script after redirection
    } else {
        // Show an error message if login fails
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>


