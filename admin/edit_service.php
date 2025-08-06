<?php
// Include the database connection
require 'db_connect.php';

// Check if 'id' is provided in the URL for editing
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the service details based on the 'id'
    $sql = "SELECT * FROM services WHERE id = $id";
    $result = $conn->query($sql);

    // Check if service exists
    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
    } else {
        echo "Service not found!";
        exit;
    }
} else {
    echo "No ID provided for editing!";
    exit;
}

// Check if the form is submitted for updating
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $serviceheading = $_POST['serviceheading'];
    $icon = $_FILES['icon']['name'];
    $icon_temp = $_FILES['icon']['tmp_name'];

    // If an icon is uploaded, move it to the destination folder
    if ($icon) {
        $icon_path = "../assets2/img/icon/" . $icon;
        move_uploaded_file($icon_temp, $icon_path);
    } else {
        // If no icon is uploaded, keep the current icon
        $icon = $service['icon'];
    }

    // Update the service in the database
    $update_sql = "UPDATE services SET title = '$title', description = '$description', serviceheading = $serviceheading, icon = '$icon' WHERE id = $id";
    if ($conn->query($update_sql)) {
        echo "Service updated successfully!";
        header("Location: manage-services.php"); // Redirect after update
        exit;
    } else {
        echo "Error updating service: " . $conn->error;
    }
}
?>

<?php
// Include header and sidebar
require 'header.php';
require 'sidebar.php';
?>

<?php
require 'navbar.php';  // Include the nav bar

?>
<div class="container">
    <div class="page-wrapper">
        <div class="main-content">
            <div class="edit-service-container">
                <h2 class="page-title">Edit Service</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="serviceheading">Service Heading</label>
                    <textarea name="serviceheading" id="serviceheading" placeholder="Enter Service Heading"></textarea>

                    <label for="title">Title:</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($service['title']); ?>" required>

                    <label for="description">Description:</label>
                    <textarea name="description" required><?php echo htmlspecialchars($service['description']); ?></textarea>

                    <label for="icon">Icon:</label>
                    <input type="file" name="icon" accept="image/*">
                    <br>
                    <img src="../assets2/img/icon/<?php echo htmlspecialchars($service['icon']); ?>" width="50" alt="Current Icon">

                    <button type="submit" name="submit">Update Service</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<style>
    /* Center the page content */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 20px;
    }

    .page-wrapper {
        width: 100%;
        max-width: 900px;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .edit-service-container {
        width: 100%;
    }

    .page-title {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-size: 16px;
        color: #333;
    }

    input[type="text"],
    input[type="file"],
    textarea {
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    img {
        margin-top: 10px;
    }

    /* Style adjustments for the page wrapper */
    .page-wrapper {
        padding: 30px;
    }
</style>