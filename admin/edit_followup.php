<?php
require 'db_connect.php';
require 'header.php';
require 'sidebar.php';

if (isset($_GET['id'])) {
    $followup_id = (int)$_GET['id'];
    $sql = "SELECT * FROM followup WHERE id = $followup_id";
    $result = $conn->query($sql);
    $followup = $result->fetch_assoc();
    if (!$followup) {
        die("Follow-up not found.");
    }
} else {
    die("Invalid request.");
}
?>

<title>Edit Follow Up</title>
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
</style>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php require 'navbar.php'; ?>

    <div class="container my-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Edit Client Follow Up</h4>
            </div>
            <div class="card-body p-4">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Client follow-up updated successfully!</div>
                <?php endif; ?>

                <form action="save_edit_followup.php?id=<?php echo $followup_id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="client_name" class="form-label fw-bold">Client Name</label>
                        <input type="text" class="form-control" name="client_name" id="client_name" value="<?php echo htmlspecialchars($followup['client_name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="client_phone" class="form-label fw-bold">Client Phone</label>
                        <input type="text" class="form-control" name="client_phone" id="client_phone" value="<?php echo htmlspecialchars($followup['client_phone']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="client_address" class="form-label fw-bold">Client Address</label>
                        <textarea name="client_address" id="client_address" rows="3" class="form-control" required><?php echo htmlspecialchars($followup['client_address']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="enquiry" class="form-label fw-bold">Enquiry</label>
                        <textarea name="enquiry" id="enquiry" rows="3" class="form-control" required><?php echo htmlspecialchars($followup['enquiry']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="statuts" class="form-label fw-bold">Status</label>
                        <select name="statuts" id="statuts" class="form-control" required>
                            <option value="1" <?php if ($followup['statuts'] == 1) echo 'selected'; ?>>Open</option>
                            <option value="2" <?php if ($followup['statuts'] == 2) echo 'selected'; ?>>In Progress</option>
                            <option value="3" <?php if ($followup['statuts'] == 3) echo 'selected'; ?>>Closed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Update Follow Up</button>
                </form>
            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>
</main>