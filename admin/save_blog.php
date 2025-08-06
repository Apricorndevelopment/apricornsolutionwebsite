<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Enable error reporting during development
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Sanitize inputs
    $title = $conn->real_escape_string(trim($_POST['title']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    $content = $conn->real_escape_string(trim($_POST['content']));
    $category = $conn->real_escape_string(trim($_POST['category']));
    $slug = $conn->real_escape_string(trim($_POST['slug']));
    $keywords = $conn->real_escape_string(trim($_POST['keywords']));
    $focus_keywords = $conn->real_escape_string(trim($_POST['focus_keywords']));
    $icbm = $conn->real_escape_string(trim($_POST['icbm']));
    $geo_region = $conn->real_escape_string(trim($_POST['geo_region']));
    $geo_placename = $conn->real_escape_string(trim($_POST['geo_placename']));
    $geo_position = $conn->real_escape_string(trim($_POST['geo_position']));
    $canonical = $conn->real_escape_string(trim($_POST['canonical']));
    $schema = $conn->real_escape_string(trim($_POST['schema']));

    // File upload
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $filename = basename($_FILES['image']['name']);
        $fileExt = pathinfo($filename, PATHINFO_EXTENSION);
        $newFileName = uniqid('blog_', true) . "." . strtolower($fileExt);
        $targetFilePath = $targetDir . $newFileName;

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array(strtolower($fileExt), $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $image = $newFileName;
            } else {
                die("Failed to upload image.");
            }
        } else {
            die("Invalid file type.");
        }
    }

    // Insert blog with slug properly quoted
    $sql = "INSERT INTO addedblogs (title, description, content, category, slug, image, keywords, focus_keywords, icbm, geo_region, geo_placename, geo_position, schema, canonical,)
            VALUES ('$title', '$description', '$content', '$category', '$slug', '$image','$keywords','$focus_keywords', '$icbm','$geo_region' ,'$geo_placename' ,'$geo_position','$schema','$canonical' )";

    if ($conn->query($sql) === TRUE) {
        header('Location: createblog.php?success=1');
        exit();
    } else {
        die("Error saving blog: " . $conn->error);
    }
} else {
    die("Invalid request method.");
}
