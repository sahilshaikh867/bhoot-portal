<?php
// config.php

$DB_HOST = "localhost";
$DB_USER = "root";      // phpMyAdmin me jisse login kar rahe ho
$DB_PASS = "root";          // agar password nahi hai to blank; agar hai to wahi yahan likho
$DB_NAME = "ghar_portal";

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
