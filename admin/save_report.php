<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $calls_count = $_POST['calls_count'];
    $message = $_POST['message'];
    $report_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO report (client_id, calls, message, report_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $client_id, $calls_count, $message, $report_date);

    if ($stmt->execute()) {
        header("Location: followup.php?success=Report added successfully");
    } else {
        header("Location: followup.php?error=Failed to add report");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: manage_followup.php");
}
