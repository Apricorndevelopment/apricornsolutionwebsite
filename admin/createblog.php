<?php
require 'db_connect.php';
require 'header.php';
require 'sidebar.php';

// Fetch categories
$sql = "SELECT name FROM categories";
$result = $conn->query($sql);
?>

<title>Create Blog</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
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

    <h1>Create a New Blog</h1>
    <div class="form-container">
        <form action="save_blog" method="POST" enctype="multipart/form-data" id="blogForm">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>

            <label for="keywords">Keyword:</label>
            <textarea name="keywords" id="keywords"></textarea>

            <label for="focus_keywords">Focus Keywords:</label>
            <textarea name="focus_keywords" id="focus_keywords"></textarea>

            <label for="content">Content:</label>
            <textarea name="content" id="content"></textarea>

            <label for="schema">Schema:</label>
            <textarea name="Schema" id="Schema"></textarea>

            <label for="geo_region">Geo Resgin:</label>
            <textarea name="geo_region" id="geo_region"></textarea>

            <label for="geo_placename">Geo Placename</label>
            <textarea name="geo_placename" id="geo_placename"></textarea>

            <label for="geo_position">Geo Position</label>
            <textarea name="geo_position" id="geo_position"></textarea>


            <label for="canonical">Canonical:</label>
            <textarea name="canonical" id="canonical"></textarea>

            <label for="icbm">ICBM:</label>
            <textarea name="icbm" id="icbm"></textarea>

            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="" disabled selected>Select Category</option>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</option>';
                    }
                } else {
                    echo '<option value="" disabled>No categories available</option>';
                }
                ?>
            </select>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept="image/*">

            <button type="submit">Save Blog</button>
        </form>
    </div>

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
</main>