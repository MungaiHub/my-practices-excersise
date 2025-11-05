<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usermanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            echo "Login successful! Welcome, " . htmlspecialchars($user);
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that username!";
    }
    $stmt->close();
}

$conn->close();
?>
