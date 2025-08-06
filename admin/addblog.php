
<?php
// Database connection
include"db_connect.php";
// Fetch blogs
$sql = "SELECT * FROM addedblogs ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php
require 'header.php';  // Include the header
require 'sidebar.php'; // Include the sidebar
?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
<?php
require './navbar.php';  // Include the footer
?>
    
        
       
         <header style="text-align: center; padding: 20px; background-color:rgb(255, 255, 255); color:rgb(0, 0, 0);">
        <h1>Our Latest Blogs</h1>
        <p style="font-size: 1.2rem;">Stay updated with the latest news and insights</p>
    </header>
       
    <div class="btn btn-border mt-2">
    <a href="createblog.php" class="button-link">Add a New Blog</a>
</div>


<!-- Blog List -->
<div style="max-width: 900px; margin: 20px auto; padding: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: white; border-radius: 5px;">
<?php
while ($row = $result->fetch_assoc()) {
    ?>
    <div style="margin-bottom: 30px; padding: 15px; border-bottom: 1px solid #ccc;">
        <h2 style="margin-bottom: 10px; color: #333;"><?php echo htmlspecialchars($row['title']); ?></h2>
        <p style="color: #666;"><?php echo htmlspecialchars($row['description']); ?></p>
        
        <?php 
        if (isset($row['image_path']) && !empty($row['image_path'])) { 
            // Check if the image exists
            $imagePath = $row['image_path'];
            if (file_exists($imagePath)) {
                echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Blog Image" style="max-width: 100%; height: auto; margin: 10px 0; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">';
            } else {
                echo '<p>Image not found.</p>';
            }
        }
        ?>
        
        <a href="blogdetails.php?id=<?php echo htmlspecialchars($row['id']); ?>" 
           style="display: inline-block; text-decoration: none; color: white; background-color: #007bff; padding: 10px 20px; border-radius: 5px; font-weight: bold; transition: background-color 0.3s;"
           onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'">
            Read More
        </a>
    </div>
    <?php 
}
?>

</div>
<?php
require 'footer.php';  // Include the footer

?>