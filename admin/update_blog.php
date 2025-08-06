<?php
require 'db_connect.php';

$id = $_POST['id'];
$title = $conn->real_escape_string($_POST['title']);
$description = $conn->real_escape_string($_POST['description']);
$content = $conn->real_escape_string($_POST['content']);
$category = $conn->real_escape_string($_POST['category']);
$slug = $conn->real_escape_string($_POST['slug']);

$image = '';
if (!empty($_FILES['image']['name'])) {
    $filename = basename($_FILES['image']['name']);
    $fileExt = pathinfo($filename, PATHINFO_EXTENSION);
    $newFileName = uniqid('blog_', true) . "." . strtolower($fileExt);
    $targetFilePath = "uploads/" . $newFileName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        $image = ", image='$newFileName'";
    }
}

$sql = "UPDATE addedblogs SET 
        title='$title', description='$description', content='$content',
        category='$category', slug='$slug' $image WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: manage_blogs.php");
    exit();
} else {
    die("Update failed: " . $conn->error);
}
