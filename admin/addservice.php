<?php
// Database connection
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $icon = $_FILES['icon']['name'];
    $serviceheading = $_POST['serviceheading'];

    $target_dir = "assets2/img/icon/";

    // Ensure the directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory with write permissions
    }

    // Define the full path to save the file
    $target_file = $target_dir . basename($icon);

    // Move uploaded file
    if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
        // Insert into database
        $sql = "INSERT INTO services (icon, title, description, serviceheading) VALUES ('$icon', '$title', '$description', '$serviceheading')";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>New service added successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<p class='error'>Failed to upload the file. Please check the folder permissions.</p>";
    }
}

// Close connection

?>

<?php
require 'header.php';  // Include the header
require 'sidebar.php'; // Include the sidebar
?>
<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-top: 20px;
    }

    .form-container {
        width: 90%;
        max-width: 600px;
        background: #fff;
        padding: 20px;
        margin: 30px auto;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    label {
        display: block;
        font-size: 16px;
        margin-bottom: 8px;
        color: #555;
    }

    input[type="text"],
    textarea,
    input[type="file"],
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Success and Error Messages */
    .success {
        text-align: center;
        color: green;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .error {
        text-align: center;
        color: red;
        font-weight: bold;
        margin-bottom: 15px;
    }

    /* Responsive Styles */
    @media (max-width: 600px) {
        .form-container {
            padding: 15px;
        }
    }
</style>
<style>
    form {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    textarea,
    input[type="file"],
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    button {
        background-color: #007BFF;
        color: white;
        cursor: pointer;
        border: none;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>


<h2>Add New Service</h2>




<div class="form-container">
    <div class="form-container1" style="width: 150px; margin-left: 0px;">
        <button onclick="window.history.back();" style="background-color: #007BFF;  color: white; padding: 10px 20px; border-radius: 5px; cursor: pointer; border: none;">
            Back
        </button>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="serviceheading">Service Heading</label>
        <textarea name="serviceheading" id="serviceheading" placeholder="Enter service heading"></textarea>

        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="Enter service title" required>

        <label for="description">Description:</label>
        <textarea name="description" placeholder="Enter service description" required></textarea>

        <label for="icon">Icon:</label>
        <input type="file" name="icon" accept="image/*" required>

        <button type="submit">Add Service</button>
    </form>
</div>
<?php
require 'footer.php';  // Include the footer

?>