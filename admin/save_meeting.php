<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $meeting_date = $_POST['meeting_date'];
    $meeting_notes = $_POST['meeting_notes'] ?? '';
    $send_reminder = isset($_POST['send_reminder']) ? 1 : 0;

    // Save the meeting
    $stmt = $conn->prepare("INSERT INTO meetings
                          (client_id, meeting_date, meeting_notes, status)
                          VALUES (?, ?, ?, 'scheduled')");
    $stmt->bind_param("iss", $client_id, $meeting_date, $meeting_notes);
    $stmt->execute();

    // Send notification if requested
    if ($send_reminder) {
        $client_info = $conn->query("SELECT client_name FROM followup WHERE id = $client_id")->fetch_assoc();
        $message = "Meeting scheduled with {$client_info['client_name']} on " .
            date('d M Y h:i A', strtotime($meeting_date));
    }

    header("Location: followup.php");
    exit();
}
