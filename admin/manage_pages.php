<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {

    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? null;
    $slug = $_POST['slug'] ?? '';
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $keyword = $_POST['keyword'] ?? '';
    $geoplacename = $_POST['geoplacename'] ?? '';
    $georegion = $_POST['georegion'] ?? '';
    $geoposition = $_POST['geoposition'] ?? '';
    $icbm = $_POST['icbm'] ?? '';
    $canonical = $_POST['canonical'] ?? '';
    $carouseltext = $_POST['carouseltext'] ?? '';
    $servicehading = $_POST['servicehading'] ?? '';
    $company_details = $_POST['company_details'] ?? '';

    if ($action === 'create' || $action === 'update') {
        if (
            empty($slug) || empty($title) || empty($content) || empty($keyword) || empty($geoplacename) ||
            empty($georegion) || empty($geoposition) || empty($icbm) || empty($canonical) || empty($carouseltext) ||
            empty($servicehading) || empty($company_details)
        ) {
            echo "All fields are required.";
            exit;
        }

        if ($action === 'create') {
            // Check for duplicate slug
            $stmt_check = $conn->prepare("SELECT COUNT(*) FROM pages WHERE slug = ?");
            $stmt_check->bind_param("s", $slug);
            $stmt_check->execute();
            $stmt_check->bind_result($slug_count);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($slug_count > 0) {
                echo "The slug '$slug' already exists. Please choose another one.";
                exit;
            }

            // Insert into database
            $stmt = $conn->prepare("INSERT INTO pages (slug, title, content, keyword, geoplacename, georegion, geoposition, icbm, canonical, carouseltext, servicehading, company_details) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssss", $slug, $title, $content, $keyword, $geoplacename, $georegion, $geoposition, $icbm, $canonical, $carouseltext, $servicehading, $company_details);

            if (!$stmt->execute()) {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            } else {
                echo "<script>alert('New service added successfully.');</script>";
            }
            $stmt->close();
        } elseif ($action === 'update') {
            // Update existing record
            $stmt = $conn->prepare("UPDATE pages SET slug = ?, title = ?, content = ?, keyword = ?, geoplacename = ?, georegion = ?, geoposition = ?, icbm = ?, canonical = ?, carouseltext = ?, servicehading = ?, company_details = ? WHERE id = ?");
            $stmt->bind_param("ssssssssssssi", $slug, $title, $content, $keyword, $geoplacename, $georegion, $geoposition, $icbm, $canonical, $carouseltext, $servicehading, $company_details, $id);

            if (!$stmt->execute()) {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            } else {
                echo "<script>alert('page Updated  successfully.');</script>";
            }
            $stmt->close();
        }
    } elseif ($action === 'delete') {
        // Delete record
        $stmt = $conn->prepare("DELETE FROM pages WHERE id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        } else {
            echo "<script>alert('page Updated  successfully.');</script>";
        }
        $stmt->close();
    }
}

// Fetch all pages for display
$result = $conn->query("SELECT * FROM pages");
?>

<!-- Rest of the HTML content -->

<?php
require 'header.php';  // Include the header
require 'sidebar.php'; // Include the sidebar
?>


<style>
    /* General body styling */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f5f5f5;
    }

    /* Form styling */
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    form input[type="text"],
    form textarea {
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s ease;
    }

    form input[type="text"]:focus,
    form textarea:focus {
        border-color: #007bff;
    }

    form button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #0056b3;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table th,
    table td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
    }

    table th {
        background-color: #007bff;
        color: #fff;
    }

    table tr {
        transition: background-color 0.3s ease;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    /* Button styling inside the table */
    table button {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    table button:hover {
        background-color: #218838;
    }

    table form button {
        background-color: #dc3545;
    }

    table form button:hover {
        background-color: #c82333;
    }

    /* Animation for table row insertion */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    table tbody tr {
        animation: fadeIn 0.5s ease-in-out;
    }
</style>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <!-- Navbar -->
<?php
require './navbar.php';  // Include the footer
?>
    <header style="text-align: center; padding: 20px; background-color:rgb(255, 255, 255); color:rgb(0, 0, 0);">
        <h1>Pages creation</h1>
    </header>

    <h1>Manage Pages slug</h1>

    <!-- Form for creating and updating pages -->
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="id" id="pageId">
        <input type="hidden" name="action" id="formAction" value="create">
        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="slug" required>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="content">Content Description:</label>
        <textarea name="content" id="content" required></textarea>
        <label for="keyword">Keywords:</label>
        <textarea name="keyword" id="keyword"></textarea>
        <label for="geoplacename">Geo.Placename:</label>
        <textarea name="geoplacename" id="geoplacename"></textarea>
        <label for="georegion">Geo.Region:</label>
        <textarea name="georegion" id="georegion"></textarea>
        <label for="geoposition">Geo.Position:</label>
        <textarea name="geoposition" id="geoposition"></textarea>
        <label for="icbm">ICBM:</label>
        <textarea name="icbm" id="icbm"></textarea>
        <label for="canonical">Canonical:</label>
        <textarea name="canonical" id="canonical"></textarea>

        <h1>Manage Pages Content</h1>

        <label for="carouseltext">Carousel Text:</label>
        <input type="text" name="carouseltext" id="carouseltext" required>
        <label for="servicehading">Service Heading:</label>
        <input type="text" name="servicehading" id="servicehading" required>

        <label for="company_details">Company Details</label>
        <input type="text" id="company_details" name="company_details">



        <button type="submit">Save</button>
    </form>

    <!-- Display existing pages -->
    <h2>Existing Pages</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['slug']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td>
                        <button onclick="editPage(
                        <?= htmlspecialchars(json_encode($row['id'])) ?>,
                        '<?= htmlspecialchars($row['slug'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['content'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['keyword'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['geoplacename'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['georegion'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['geoposition'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['icbm'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['canonical'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['carouseltext'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($row['servicehading'], ENT_QUOTES) ?>',
                       
                        '<?= htmlspecialchars($row['company_details'], ENT_QUOTES) ?>',
                       
                    )">Edit</button>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        function editPage(id, slug, title, content, keyword, geoplacename, georegion, geoposition, icbm, canonical, carouseltext, servicehading, company_details) {
            document.getElementById('pageId').value = id;
            document.getElementById('slug').value = slug;
            document.getElementById('title').value = title;
            document.getElementById('content').value = content;
            document.getElementById('keyword').value = keyword;
            document.getElementById('geoplacename').value = geoplacename;
            document.getElementById('georegion').value = georegion;
            document.getElementById('geoposition').value = geoposition;
            document.getElementById('icbm').value = icbm;
            document.getElementById('canonical').value = canonical;
            document.getElementById('carouseltext').value = carouseltext;
            document.getElementById('servicehading').value = servicehading;
            document.getElementById('company_details').value = company_details;
            document.getElementById('formAction').value = 'update';

        }
    </script>
<?php
require 'footer.php';  // Include the footer
?>

<?php
$conn->close();
?>