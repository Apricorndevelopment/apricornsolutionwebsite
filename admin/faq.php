<?php
require 'db_connect.php';
require 'header.php';  // Include the header
require 'sidebar.php'; // Include the sidebar
// Add FAQ
if (isset($_POST['add_faq'])) {
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $delay = $_POST['delay'];
    $page_id = $_POST['page_id']; // Get the page_id from the form

    // Insert the FAQ into the database
    $sql = "INSERT INTO faqs (question, answer, delay, page_id) VALUES ('$question', '$answer', '$delay', '$page_id')";

    // If the insert was successful, redirect to the same page to prevent resubmission
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('FAQ added successfully');</script>";
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page to avoid resubmitting on refresh
        exit; // Terminate further script execution after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete FAQ
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM faqs WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('FAQ deleted successfully');</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>


<style>
    /* Reset and Body styles */
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
    }

    /* Flexbox setup for page layout */
    .wrapper {
        display: flex;
        min-height: 100vh;
        padding-top: 60px;
    }

    /* Sidebar styling */
    .sidebar {
        width: 250px;
        background-color: #f8f9fa;
        padding: 15px;
        border-right: 1px solid #ddd;
        height: 100vh;
    }

    /* Main content area styling */
    .main-content {
        flex-grow: 1;
        background-color: #fff;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 100%;
        overflow-y: auto;
    }

    /* Container for FAQ content */
    .container {
        width: 100%;
        max-width: 1200px;
        margin-left: 20px;
    }

    /* Make sure tables and forms are responsive */
    .table {
        width: 100%;
    }

    /* Center the heading text */
    h2 {
        margin-bottom: 20px;
    }

    /* Adjust the card styles */
    .card {
        width: 100%;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    /* Add some padding and spacing inside the form */
    .form-label {
        font-weight: bold;
    }
</style>
<main class="main-content position-relative  h-100 border-radius-lg" style="
    max-width: 100%;
    background-color: white;
    padding: 10px;
" >

<!-- Navbar -->
<?php
require './navbar.php';  // Include the footer
?>
<div class="wrapper">
   

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2 class="text-center mb-4">Admin Panel - Manage FAQs</h2>

            <!-- Add FAQ Form -->
            <div class="card p-4 mb-4">
                <h4>Add New FAQ</h4>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question" required>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="delay" class="form-label">Animation Delay (e.g., .3s, .5s)</label>
                        <input type="text" class="form-control" id="delay" name="delay" required>
                    </div>

                    <div class="mb-3">
                        <label for="page_id" class="form-label">Page ID</label>
                        <input type="number" class="form-control" id="page_id" name="page_id" required>
                    </div>
                    <button type="submit" name="add_faq" class="btn btn-primary">Add FAQ</button>
                </form>
            </div>

            <!-- FAQ List -->
            <div class="card p-4">
                <h4>FAQ List</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Delay</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch all FAQs from the database
                        $sql = "SELECT * FROM faqs ORDER BY id ASC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['question']}</td>
                                    <td>{$row['answer']}</td>
                                    <td>{$row['delay']}</td>
                                    <td>
                                        <a href='?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No FAQs Found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require 'footer.php'; // Include the footer (if necessary)
?>