<?php
// Backend/login.php

session_start();
require_once __DIR__ . '/config.php';  // yahi se $conn mil jayega

$email    = trim($_POST['email'] ?? '');
$pass_raw = $_POST['password'] ?? '';

if (!$email || !$pass_raw) {
    die("Email & password required.");
}

$stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($pass_raw, $row['password_hash'])) {
        $_SESSION['user_id'] = $row['id'];
        header("Location: ../index.html");   // ya index.php jo bhi hai
        exit;
    } else {
        echo "Wrong password.";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
