<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $client_name = $conn->real_escape_string(trim($_POST['client_name']));
    $client_phone = $conn->real_escape_string(trim($_POST['client_phone']));
    $client_address = $conn->real_escape_string(trim($_POST['client_address']));
    $enquiry = $conn->real_escape_string(trim($_POST['enquiry']));
    $statuts = (int) $_POST['statuts'];

    $sql = "UPDATE followup
            SET client_name = '$client_name',
                client_phone = '$client_phone',
                client_address = '$client_address',
                enquiry = '$enquiry',
                statuts = $statuts,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: edit_followup.php?id=$id&success=1");
        exit();
    } else {
        die("Error updating follow-up: " . $conn->error);
    }
} else {
    die("Invalid request.");
}
