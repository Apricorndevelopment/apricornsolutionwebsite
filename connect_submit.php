<?php
include "./admin/db_connect.php";

// Get POST data
$name    = $_POST['name'];
$address = $_POST['address'];
$email   = $_POST['email'];
$contact = $_POST['contact'];
$enquiry = $_POST['enquiry'];

// Insert into DB
$sql = "INSERT INTO connect_enquiries (name, address, email, contact, enquiry) 
        VALUES ('$name', '$address', '$email', '$contact', '$enquiry')";

if ($conn->query($sql) === TRUE) {
    echo "Your enquiry has been submitted!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
