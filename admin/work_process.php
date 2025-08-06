<?php
require 'db_connect.php';
require 'header.php';  // Include the header
require 'sidebar.php'; // Include the sidebar


// Add Step
if (isset($_POST['add_step'])) {
    $step_number = $_POST['step_number'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $delay = $_POST['delay'];

    $sql = "INSERT INTO work_process_steps (step_number, title, description, delay) VALUES ('$step_number', '$title', '$description', '$delay')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Step added successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete Step
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM work_process_steps WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Step deleted successfully');</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>



<style>
    .main-content {
        margin: 2rem auto;
        padding: 1.5rem;
        background-color: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        max-width: 900px;
    }

    .main-content h2 {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .main-content h4 {
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .btn {
        border-radius: 8px;
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
<div class="container-fluid d-flex">
    <div class="row flex-grow-1" style="width: 100%;">
        
                <h2 class="text-center mb-4">Admin Panel - Manage Steps</h2>

                <!-- Add Step Form -->
                
                    <h4>Add New Step</h4>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="step_number" class="form-label">Step Number</label>
                            <input type="number" class="form-control" id="step_number" name="step_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="delay" class="form-label">Animation Delay (e.g., .2s, .4s)</label>
                            <input type="text" class="form-control" id="delay" name="delay" required>
                        </div>
                        <button type="submit" name="add_step" class="btn btn-primary">Add Step</button>
                    </form>
                

                <!-- Steps List -->
                <div class="card p-4">
    <h4>Steps List</h4>
    <div class="table-responsive"> <!-- Keep table structure responsive -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 10%;">Step Number</th>
                    <th style="width: 20%;">Title</th>
                    <th style="width: 35%; word-wrap: break-word; white-space: normal;">Description</th> <!-- Word wrapping applied -->
                    <th style="width: 10%;">Delay</th>
                    <th style="width: 20%;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM work_process_steps ORDER BY step_number ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['step_number']}</td>
                            <td>{$row['title']}</td>
                            <td style='word-wrap: break-word; white-space: normal;'>{$row['description']}</td> <!-- Inline style for wrapping -->
                            <td>{$row['delay']}</td>
                            <td>
                                <a href='?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No Steps Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>



            </div>
        
    </div>

                       
<?php
require 'footer.php';  // Include the footer
?>