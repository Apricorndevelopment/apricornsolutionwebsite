<?php
// Database connection
require 'db_connect.php';

// Delete service if requested
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM services WHERE id = $id");
    header("Location: manage-services.php");
    exit;
}

// Fetch all services
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<?php
// Include header
require 'header.php';
// require 'sidebar.php';
?>

<div class="page-wrapper">
    <?php require 'sidebar.php'; ?>

    <div class="main-content">
        <style>
            .container {
                margin: 20px auto;
                max-width: 1200px;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .page-title {
                font-size: 24px;
                margin-bottom: 20px;
                color: #333;
            }

            .btn {
                padding: 8px 12px;
                font-size: 14px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-primary {
                background-color: #007bff;
                color: #fff;
            }

            .btn-warning {
                background-color: #ffc107;
                color: #fff;
            }

            .btn-danger {
                background-color: #dc3545;
                color: #fff;
            }

            .btn:hover {
                opacity: 0.9;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .table th,
            .table td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ddd;
            }

            .table th {
                background-color: #f4f4f4;
                font-weight: bold;
            }

            .table img {
                border-radius: 4px;
            }
        </style>




        <div class="container">
            <h2 class="page-title">Manage Services</h2>
            <a href="addservice.php" class="btn btn-primary">Add New Service</a><br><br>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['serviceheading']); ?></td>
                            <td><img src="../assets2/img/icon/<?php echo htmlspecialchars($row['icon']); ?>" width="50" alt="Icon"></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
                                <a href="edit_service.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>

                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>

</html>