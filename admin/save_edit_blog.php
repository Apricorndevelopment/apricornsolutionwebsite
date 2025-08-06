<?php
// Start output buffering to prevent premature output
ob_start();

// Include necessary files
require 'db_connect.php';
require 'header.php';
require 'sidebar.php';

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch blog details from database
    $sql = "SELECT * FROM addedblogs WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $blog = $result->fetch_assoc();
    } else {
        die("Blog not found.");
    }
} else {
    die("Invalid request.");
}

// Handle form submission to update blog
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
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

    // Image handling (if a new image is uploaded)
    $image = $blog['image']; // Default image if no new image is uploaded

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

    // Update blog in the database
    $sql = "UPDATE addedblogs SET title = '$title', description = '$description', content = '$content', category = '$category', slug = '$slug', image = '$image', keywords= '$keywords', focus_keywords ='$focus_keywords',
            icbm ='$icbm', geo_region = '$geo_region', geo_placename = '$geo_placename' , geo_position = '$geo_position', canonical = '$canonical', schema ='$schema'  WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect after successful update
        header('Location: manage_blogs.php?success=1');
        exit();  // Ensure script stops here
    } else {
        die("Error updating blog: " . $conn->error);
    }
}
?>

<title>Edit Blog</title>

<!-- Add some basic styles -->
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        color: #333;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
        color: #000;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    }

    .form-container {
        margin: 30px auto;
        padding: 30px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
        color: #555;
    }

    input[type="text"],
    textarea,
    input[type="file"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    button {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: #5cb85c;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 18px;
        cursor: pointer;
    }

    button:hover {
        background-color: #4cae4c;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 15px;
        }

        button {
            font-size: 16px;
            padding: 10px;
        }
    }
</style>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <h1>Edit Blog</h1>
    <div class="form-container">
        <form action="save_edit_blog.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>

            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" value="<?php echo htmlspecialchars($blog['slug']); ?>" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($blog['description']); ?></textarea>


            <label for="keywords">Keywords:</label>
            <textarea name="Keywords" id="Keywords" rows="4" required><?php echo htmlspecialchars($blog['keywords']); ?></textarea>


            <label for="focus_keywords">Focus Keywords:</label>
            <textarea name="focus_keywords" id="focus_keywords" rows="4" required><?php echo htmlspecialchars($blog['focus_keywords']); ?></textarea>

            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="6" required><?php echo htmlspecialchars($blog['content']); ?></textarea>

            <label for="icbm">ICBM:</label>
            <textarea name="icbm" id="icbm" rows="6" required><?php echo htmlspecialchars($blog['icbm']); ?></textarea>

            <label for="geo_region">Geo Region:</label>
            <textarea name="geo_region" id="geo_region" rows="6" required><?php echo htmlspecialchars($blog['geo_region']); ?></textarea>

            <label for="geo_placename">Geo Placename:</label>
            <textarea name="geo_placename" id="geo_placename" rows="6" required><?php echo htmlspecialchars($blog['geo_placename']); ?></textarea>

            <label for="geo_position">Geo Position:</label>
            <textarea name="geo_position" id="geo_position" rows="6" required><?php echo htmlspecialchars($blog['geo_position']); ?></textarea>

            <label for="canonical">Canonical:</label>
            <textarea name="canonical" id="canonical" rows="6" required><?php echo htmlspecialchars($blog['canonical']); ?></textarea>


            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="" disabled>Select Category</option>
                <?php
                // Fetch categories for the dropdown
                $sql = "SELECT * FROM categories";
                $categories = $conn->query($sql);
                while ($category = $categories->fetch_assoc()) {
                    echo '<option value="' . $category['name'] . '" ' . ($category['name'] == $blog['category'] ? 'selected' : '') . '>' . $category['name'] . '</option>';
                }
                ?>
            </select>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept="image/*">
            <?php if ($blog['image']) { ?>
                <img src="uploads/<?php echo $blog['image']; ?>" alt="Blog Image" width="100">
            <?php } ?>

            <button type="submit">Update Blog</button>
        </form>
    </div>
</main>

<script>
    CKEDITOR.replace('description');
    CKEDITOR.replace('content');
</script>

<?php
// End the output buffer and flush the output
ob_end_flush();
require 'footer.php';
?>