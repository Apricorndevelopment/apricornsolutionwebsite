<?php
require 'db_connect.php';
require 'header.php';
require 'sidebar.php';

if (isset($_GET['id'])) {
    $blog_id = $_GET['id'];
    $sql = "SELECT * FROM addedblogs WHERE id = $blog_id";
    $result = $conn->query($sql);
    $blog = $result->fetch_assoc();
    if (!$blog) {
        die("Blog not found.");
    }
} else {
    die("Invalid request.");
}

$sql_categories = "SELECT name FROM categories";
$result_categories = $conn->query($sql_categories);
?>

<title>Edit Blog</title>
<!-- <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.tiny.cloud/1/s0c11uubwkkuyuzzbt40l69howndqcpb5t472yw6s0dargd4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    body {
        background-color: #f4f4f9;
        color: #333;
        font-family: Arial, sans-serif;
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
        max-width: 700px;
    }

    label {
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
</style>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php require 'navbar.php'; ?>

    <div class="container my-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Edit Blog</h4>
            </div>
            <div class="card-body p-4">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Blog updated successfully!</div>
                <?php endif; ?>

                <form action="save_edit_blog.php?id=<?php echo $blog_id; ?>" method="POST" enctype="multipart/form-data" id="editBlogForm">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label fw-bold">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="<?php echo htmlspecialchars($blog['slug']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control" required><?php echo htmlspecialchars($blog['description']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="keywords" class="form-label fw-bold">Keywords</label>
                        <textarea name="keywords" id="keywords" rows="4" class="form-control" required><?php echo htmlspecialchars($blog['keywords']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="focus_keywords" class="form-label fw-bold">Focus Keywords</label>
                        <textarea name="focus_keywords" id="focus_keywords" rows="4" class="form-control" required><?php echo htmlspecialchars($blog['focus_keywords']); ?></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="content" class="form-label fw-bold">Content</label>
                        <textarea name="content" id="content" rows="6" class="form-control" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="schema" class="form-label fw-bold">Schema</label>
                        <textarea name="schema" id="schema" rows="6" class="form-control" required><?php echo htmlspecialchars($blog['schema']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="icbm" class="form-label fw-bold">ICBM</label>
                        <textarea name="icbm" id="icbm" rows="6" class="form-control" required><?php echo htmlspecialchars($blog['icbm']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="geo_region" class="form-label fw-bold">Geo Region</label>
                        <textarea name="geo_region" id="geo_region" rows="6" class="form-control" required><?php echo htmlspecialchars($blog['geo_region']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="geo_placename" class="form-label fw-bold">Geo Placename</label>
                        <textarea name="geo_placename" id="geo_placename" rows="6" class="form-control" required><?php echo htmlspecialchars($blog['geo_placename']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="geo_position" class="form-label fw-bold">Geo Position</label>
                        <textarea name="geo_position" id="geo_position" rows="6" class="form-control" required><?php echo htmlspecialchars($blog['geo_position']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="canonical" class="form-label fw-bold">Canonical</label>
                        <textarea name="canonical" id="canonical" rows="6" class="form-control" required><?php echo htmlspecialchars($blog['canonical']); ?></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold">Category</label>
                        <select name="category" id="category" class="form-select" required>
                            <option value="" disabled>Select Category</option>
                            <?php
                            if ($result_categories && $result_categories->num_rows > 0) {
                                while ($row = $result_categories->fetch_assoc()) {
                                    $selected = ($row['name'] == $blog['category']) ? 'selected' : '';
                                    echo '<option value="' . htmlspecialchars($row['name']) . '" ' . $selected . '>' . htmlspecialchars($row['name']) . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No categories available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        <small class="form-text text-muted">Leave empty if you don’t want to change the image.</small>
                        <?php if ($blog['image']): ?>
                            <div class="mt-2">
                                <strong>Current Image:</strong>
                                <img src="uploads/<?php echo $blog['image']; ?>" width="150" alt="Blog Image">
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Update Blog</button>
                </form>
            </div>
        </div>
    </div>

    // <script>
        //     CKEDITOR.replace('description');
        //     CKEDITOR.replace('content');

        //     document.getElementById('editBlogForm').addEventListener('submit', function(e) {
        //         const content = CKEDITOR.instances['content'].getData().trim();
        //         if (content === "") {
        //             e.preventDefault();
        //             alert("Content cannot be empty!");
        //         }
        //     });
        //
        //
        //
    </script>

    <script>
        tinymce.init({
            selector: '#description, #content',
            plugins: 'lists link image preview',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
            height: 300,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        document.getElementById('blogForm').addEventListener('submit', function(e) {
            var desc = tinymce.get('description').getContent().trim();
            var cont = tinymce.get('content').getContent().trim();

            if (!desc || !cont) {
                e.preventDefault();
                alert('Both description and content are required.');
            }
        });
    </script>


    <?php require 'footer.php'; ?>