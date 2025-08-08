<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Enable error reporting during development
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Sanitize inputs
    $client_name = $conn->real_escape_string(trim($_POST['client_name']));
    $client_phone = $conn->real_escape_string(trim($_POST['client_phone']));
    $client_address    = $conn->real_escape_string(trim($_POST['client_address']));
    $enquiry = $conn->real_escape_string(trim($_POST['enquiry']));
    $statuts = (int) $_POST['statuts'];



    // Insert blog with slug properly quoted
    $sql = "INSERT INTO followup (client_name, client_phone, client_address, enquiry, statuts)
            VALUES ('$client_name', '$client_phone', '$client_address', '$enquiry', '$statuts' )";

    if ($conn->query($sql) === TRUE) {
        header('Location: followup.php?success=1');
        exit();
    } else {
        die("Error saving Followup: " . $conn->error);
    }
} else {
    die("Invalid request method.");
}
