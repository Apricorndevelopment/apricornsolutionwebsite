<?php
require 'db_connect.php';
require 'header.php';
require 'sidebar.php';
$result = $conn->query("SELECT * FROM addedblogs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Blogs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <style>
        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #fff;
        }

        .table {
            width: 100%;
            table-layout: fixed;
            word-wrap: break-word;
        }

        .table th,
        .table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
        }

        .table td img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 4px;
        }

        /* Optional: Improve readability and spacing */
        .table th,
        .table td {
            padding: 12px 15px;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php require 'navbar.php'; ?>
        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Manage Blogs</h2>
                <a href="createblog.php" class="btn btn-primary">+ Add Blog</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Slug</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td>
                                    <img src="uploads/<?= $row['image'] ?>" alt="" width="60" height="40" style="object-fit: cover;">
                                </td>
                                <td><?= htmlspecialchars($row['title']) ?></td>
                                <td><?= htmlspecialchars($row['category']) ?></td>
                                <td><?= htmlspecialchars($row['slug']) ?></td>
                                <td class="text-end">
                                    <a href="edit_blog.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <a href="delete_blog.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

</body>

</html>
<?php
require 'footer.php';
?>