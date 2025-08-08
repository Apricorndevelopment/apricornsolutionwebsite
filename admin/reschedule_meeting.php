<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meeting_id = $_POST['meeting_id'];
    $client_id = $_POST['client_id'];
    $new_meeting_date = $_POST['new_meeting_date'];
    $additional_notes = $_POST['additional_notes'] ?? '';
    $send_reminder = isset($_POST['send_reminder']) ? 1 : 0;

    // Get existing notes
    $existing_notes = $conn->query("SELECT meeting_notes FROM meetings WHERE id = $meeting_id")->fetch_assoc()['meeting_notes'];
    $combined_notes = $existing_notes . "\n\nRescheduled on: " . date('Y-m-d H:i') . "\n" . $additional_notes;

    // Update the meeting
    $stmt = $conn->prepare("UPDATE meetings SET
                          meeting_date = ?,
                          meeting_notes = ?,
                          status = 'scheduled',
                          updated_at = NOW()
                          WHERE id = ?");
    $stmt->bind_param("ssi", $new_meeting_date, $combined_notes, $meeting_id);
    $stmt->execute();

    // Send notification if requested
    if ($send_reminder) {
        $client_info = $conn->query("SELECT client_name FROM followup WHERE id = $client_id")->fetch_assoc();
        $message = "Meeting rescheduled with {$client_info['client_name']} on " .
            date('d M Y h:i A', strtotime($new_meeting_date));

        // Implement your SMS sending function here
        // sendSMSNotification('YOUR_NUMBER', $message);
    }

    header("Location: followup.php");
    exit();
}
