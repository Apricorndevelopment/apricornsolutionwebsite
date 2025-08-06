<?php
ob_start();
session_start();
require 'db_connect.php';
require 'header.php';
require 'sidebar.php';

// Add or Update FAQ
if (isset($_POST['add_faq'])) {
    $questions = $_POST['question'];
    $answers = $_POST['answer'];
    $blog_ids = $_POST['blog_id'];
    $faq_ids = $_POST['faq_id']; // This will be empty for new entries

    // Prepare both INSERT and UPDATE statements
    $insert_stmt = $conn->prepare("INSERT INTO addblogfaq (question, answer, blog_id) VALUES (?, ?, ?)");
    $update_stmt = $conn->prepare("UPDATE addblogfaq SET question = ?, answer = ?, blog_id = ? WHERE id = ?");

    // Loop through all FAQ entries
    $successCount = 0;
    for ($i = 0; $i < count($questions); $i++) {
        if (!empty($questions[$i]) && !empty($answers[$i])) {
            if (!empty($faq_ids[$i])) {
                // Update existing FAQ
                $update_stmt->bind_param("ssii", $questions[$i], $answers[$i], $blog_ids[$i], $faq_ids[$i]);
                if ($update_stmt->execute()) {
                    $successCount++;
                }
            } else {
                // Insert new FAQ
                $insert_stmt->bind_param("ssi", $questions[$i], $answers[$i], $blog_ids[$i]);
                if ($insert_stmt->execute()) {
                    $successCount++;
                }
            }
        }
    }

    if ($successCount > 0) {
        $_SESSION['message'] = "<script>alert('Successfully processed $successCount FAQ(s)');</script>";
    }
    ob_end_clean();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Delete FAQ
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $sql = "DELETE FROM addblogfaq WHERE id = $id";
    if ($conn->query($sql)) {
        $_SESSION['message'] = "<script>alert('FAQ deleted successfully');</script>";
        ob_end_clean();
        header("Location: addblogfaq.php");
        exit;
    } else {
        $_SESSION['message'] = "<script>alert('Error deleting FAQ: " . $conn->error . "');</script>";
    }
}

// Fetch FAQ for editing
$edit_faq = null;
if (isset($_GET['edit_id'])) {
    $edit_id = (int)$_GET['edit_id'];
    $result = $conn->query("SELECT * FROM addblogfaq WHERE id = $edit_id");
    if ($result->num_rows > 0) {
        $edit_faq = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQs</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
            padding-top: 60px;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 15px;
            border-right: 1px solid #ddd;
            height: 100vh;
        }

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

        .container {
            width: 100%;
            max-width: 1200px;
            margin-left: 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        h2 {
            margin-bottom: 20px;
            color: #343a40;
        }

        .card {
            width: 100%;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .faq-entry {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #f8f9fa;
            position: relative;
        }

        .add-more {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .action-btns {
            white-space: nowrap;
        }

        .edit-mode {
            border: 2px solid #ffc107;
            background-color: #fffdf5;
        }
    </style>
</head>

<body>
    <main class="main-content position-relative h-100 border-radius-lg">
        <?php
        require './navbar.php';
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>

        <div class="wrapper">
            <div class="main-content">
                <div class="container">
                    <h2 class="text-center mb-4">Admin Panel - Manage FAQs</h2>

                    <!-- Add/Edit FAQ Form -->
                    <div class="card p-4 mb-4">
                        <h4><?= isset($edit_faq) ? 'Edit FAQ' : 'Add New FAQ' ?></h4>
                        <form method="POST" action="" id="faq-form">
                            <div id="faq-entries">
                                <?php if (isset($edit_faq)): ?>
                                    <!-- Edit Mode - Single Entry -->
                                    <div class="faq-entry edit-mode">
                                        <input type="hidden" name="faq_id[]" value="<?= $edit_faq['id'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <input type="text" class="form-control" name="question[]" value="<?= htmlspecialchars($edit_faq['question']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer</label>
                                            <textarea class="form-control" name="answer[]" rows="3" required><?= htmlspecialchars($edit_faq['answer']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select Blog</label>
                                            <select class="form-control" name="blog_id[]" required>
                                                <?php
                                                $blog_query = "SELECT id, title FROM addedblogs ORDER BY title";
                                                $blog_result = $conn->query($blog_query);

                                                if ($blog_result->num_rows > 0) {
                                                    while ($blog = $blog_result->fetch_assoc()) {
                                                        $selected = ($blog['id'] == $edit_faq['blog_id']) ? 'selected' : '';
                                                        echo "<option value='{$blog['id']}' $selected>{$blog['title']}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <a href="addblogfaq.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                <?php else: ?>
                                    <!-- Add Mode - Multiple Entries -->
                                    <div class="faq-entry">
                                        <input type="hidden" name="faq_id[]" value="">
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <input type="text" class="form-control" name="question[]" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer</label>
                                            <textarea class="form-control" name="answer[]" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select Blog</label>
                                            <select class="form-control" name="blog_id[]" required>
                                                <?php
                                                $blog_query = "SELECT id, title FROM addedblogs ORDER BY title";
                                                $blog_result = $conn->query($blog_query);

                                                if ($blog_result->num_rows > 0) {
                                                    while ($blog = $blog_result->fetch_assoc()) {
                                                        echo "<option value='{$blog['id']}'>{$blog['title']}</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No blogs available</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeFaqEntry(this)" style="display: none;">Remove</button>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (!isset($edit_faq)): ?>
                                <button type="button" class="btn btn-secondary add-more" onclick="addFaqEntry()">Add More FAQ</button>
                            <?php endif; ?>
                            <button type="submit" name="add_faq" class="btn btn-primary"><?= isset($edit_faq) ? 'Update FAQ' : 'Save All FAQs' ?></button>
                        </form>
                    </div>

                    <!-- FAQ List -->
                    <div class="card p-4">
                        <h4>FAQ List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Blog</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT f.*, b.title as blog_title FROM addblogfaq f LEFT JOIN addedblogs b ON f.blog_id = b.id ORDER BY f.id ASC";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>" . htmlspecialchars($row['question']) . "</td>
                                                <td>" . htmlspecialchars($row['answer']) . "</td>
                                                <td>{$row['blog_title']}</td>
                                                <td class='action-btns'>
                                                    <a href='?edit_id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                    <a href='?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this FAQ?\")'>Delete</a>
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
        </div>

        <script>
            function addFaqEntry() {
                const container = document.getElementById('faq-entries');
                const newEntry = document.createElement('div');
                newEntry.className = 'faq-entry';

                const firstEntry = container.querySelector('.faq-entry:not(.edit-mode)');
                newEntry.innerHTML = firstEntry.innerHTML;

                const inputs = newEntry.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    if (input.type !== 'button' && input.type !== 'hidden') {
                        input.value = '';
                    }
                });

                newEntry.querySelector('.remove-btn').style.display = 'block';
                container.appendChild(newEntry);
            }

            function removeFaqEntry(button) {
                const entries = document.getElementById('faq-entries');
                if (entries.children.length > 1) {
                    button.closest('.faq-entry').remove();
                } else {
                    alert("You must keep at least one FAQ entry.");
                }
            }
        </script>

        <?php require 'footer.php'; ?>
    </main>
</body>

</html>
<?php ob_end_flush(); ?>