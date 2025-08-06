<?php
require 'db_connect.php';

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Check if there are any categories dependent on this category
    $checkDependencyStmt = $conn->prepare("SELECT COUNT(*) FROM categories WHERE parent_id = ?");
    $checkDependencyStmt->bind_param("i", $categoryId);
    $checkDependencyStmt->execute();
    $result = $checkDependencyStmt->get_result();
    $row = $result->fetch_row();

    // If there are dependent categories, show popup message
    if ($row[0] > 0) {
        echo "<script type='text/javascript'>
                alert('This category has dependent categories. Please remove them first.');
                window.location.href = 'category.php'; // Redirect to category listing page
              </script>";
    } else {
        // No dependencies, proceed with deletion
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Show success message in a popup
            echo "<script type='text/javascript'>
                    alert('Category deleted successfully!');
                    window.location.href = 'category.php'; // Redirect to category listing page
                  </script>";
        } else {
            // Show failure message in a popup
            echo "<script type='text/javascript'>
                    alert('Failed to delete category. Try again!');
                    window.location.href = 'category.php'; // Redirect to category listing page
                  </script>";
        }
    }
}
?>
