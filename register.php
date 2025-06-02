<?php

$servername = "localhost";
$username = "root";
$password = "test"; 
$database = "login";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $database, $port);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        die("Please fill in both fields.");
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
      'INSERT INTO users (username, password_hash) VALUES (?, ?)'
    );
    $stmt->bind_param("ss", $username, $passwordHash);
    if ($stmt->execute()) {
      echo"User registered successfully";
    } else {
      echo "Error: " . $stmt->error;
    }

    echo " You submitted: $username";
    $stmt->close();
    $conn->close();

} else {
    echo "Form not submitted yet.";
}
?>