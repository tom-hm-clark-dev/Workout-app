<?php
session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.html");
  exit;
}

$user = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Dashboard</title>
</head>

<body>
<nav>
  <ul>
    <li>Workouts</li>
    <li>Exercises</li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>

<main>
  <h2>Welcome, <?=htmlspecialchars($user) ?>!</h2>
  <p>This is your dashboard</p>
  <a href="logout.php">Logout</a>
</main>
</body>
</html>