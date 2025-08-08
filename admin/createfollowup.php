<?php
require 'db_connect.php';
require 'header.php';
require 'sidebar.php';


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

    <h1>Add New Client</h1>
    <div class="form-container">
        <form action="save_followup" method="POST" enctype="multipart/form-data" id="blogForm">
            <label for="client_name">Client Name:</label>
            <input type="text" name="client_name" id="client_name" required>

            <label for="client_phone">Client Phone Number:</label>
            <input type="text" name="client_phone" id="client_phone" required>

            <label for="client_address	">client_address:</label>
            <textarea name="client_address" id="client_address"></textarea>

            <label for="enquiry">Enquiry:</label>
            <textarea name="enquiry" id="enquiry"></textarea>

            <label for="statuts">Status:</label>
            <select name="statuts" id="statuts" required>
                <option value="1">Open</option>
                <option value="2">In Progress</option>
                <option value="3">Closed</option>
            </select>



            <button type="submit">Save Follow</button>
        </form>
    </div>



    <?php require 'footer.php'; ?>
</main>