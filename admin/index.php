<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} else {
    header("Location: dashboard.php");  // Redirect to dashboard if logged in
    exit();
}
?>
