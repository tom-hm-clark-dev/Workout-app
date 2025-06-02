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
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if (empty($username) || empty($password)) {
        die("Please fill in both fields");
    }

    $stmt = $conn->prepare('SELECT password_hash FROM users WHERE username = ?');
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $passwordHashFromDB = $row['password_hash'];

            if (password_verify($password, $passwordHashFromDB)) {
                echo "Login successful!";
                session_start();
                $_SESSION["username"] = $username;

                echo "Login successful, welcome, " . $_SESSION["username"];
                header("Location: dashboard.php");
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
