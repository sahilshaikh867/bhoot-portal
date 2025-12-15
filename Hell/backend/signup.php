<?php
// Backend/signup.php

session_start();
require_once __DIR__ . '/config.php';  // yahi connection hai

$name     = trim($_POST['name'] ?? '');
$hobby    = trim($_POST['hobby'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$pass_raw = $_POST['password'] ?? '';

if (!$name || !$hobby || !$email || !$phone || !$pass_raw) {
    die("All fields are required.");
}

$pass_hash = password_hash($pass_raw, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users (name, hobby, email, phone, password_hash) VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("sssss", $name, $hobby, $email, $phone, $pass_hash);

if ($stmt->execute()) {
    header("Location: ../login.php");   // agar login page php hai
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
