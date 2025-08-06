<?php
// // Database connection
// $conn = new mysqli('localhost', 'root', '', 'apricornsolutions');

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
include"db_connect.php";

// Fetch blogs
$sql = "SELECT * FROM blogs ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f9;">

    <header style="text-align: center; padding: 20px; background-color: #333; color: white;">
        <h1>Our Latest Blogs</h1>
        <p style="font-size: 1.2rem;">Stay updated with the latest news and insights</p>
    </header>

    <div style="max-width: 900px; margin: 20px auto; padding: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: white; border-radius: 5px;">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div style="margin-bottom: 30px; padding: 15px; border-bottom: 1px solid #ccc;">
                <h2 style="margin-bottom: 10px; color: #333;"><?php echo htmlspecialchars($row['title']); ?></h2>
                <p style="color: #666;"><?php echo htmlspecialchars($row['description']); ?></p>
                <?php if ($row['image_path']) { ?>
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Blog Image" style="max-width: 100%; height: auto; margin: 10px 0; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <?php } ?>
                <a href="../view_blog.php?id=<?php echo htmlspecialchars($row['id']); ?>" 
                   style="display: inline-block; text-decoration: none; color: white; background-color: #007bff; padding: 10px 20px; border-radius: 5px; font-weight: bold; transition: background-color 0.3s;"
                   onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'">
                    Read More
                </a>
            </div>
        <?php } ?>
    </div>

    <?php
require 'footer.php';  // Include the footer

?>

<?php
$conn->close();
?>
