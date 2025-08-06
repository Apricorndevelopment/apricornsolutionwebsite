<?php
// Database connection with error handling
require 'db_connect.php';
require 'header.php';  // Include the header
require 'sidebar.php'; // Include the sidebar


$message = ""; // Variable to hold the message
$messageType = ""; // Variable to hold message type ('success' or 'error')

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    // Capture the inputs
    $name = $_POST['name'];
    $parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : NULL; // Allow NULL if no parent is selected

    // Validate parent_id if provided
    if (!is_null($parent_id)) {
        $checkParentStmt = $conn->prepare("SELECT id FROM categories WHERE id = ?");
        $checkParentStmt->bind_param("i", $parent_id);
        $checkParentStmt->execute();
        $checkParentResult = $checkParentStmt->get_result();

        if ($checkParentResult->num_rows === 0) {
            // If parent_id does not exist
            $message = "Invalid Parent ID: The selected parent category does not exist.";
            $messageType = "error";
        }
        $checkParentStmt->close();
    }

    if (empty($message)) {
        // Insert the category
        $stmt = $conn->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $parent_id);

        if ($stmt->execute()) {
            $message = "Category added successfully!";
            $messageType = "success";
        } else {
            $message = "Error adding category: " . $stmt->error;
            $messageType = "error";
        }

        $stmt->close();
    }
}

// Fetch existing categories for the dropdown
function getCategories($conn)
{
    $categories = [];
    $result = $conn->query("SELECT id, name FROM categories WHERE parent_id IS NULL");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}


// Function to fetch all categories with parent category names
function getAllCategories() {
    global $conn;

    if ($conn) {
        $sql = "
            SELECT c.id, c.name, p.name AS parent_name 
            FROM categories c 
            LEFT JOIN categories p ON c.parent_id = p.id 
            ORDER BY c.id ASC";
        $result = $conn->query($sql);

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return $categories;
    } else {
        die("Database connection not established.");
    }
}


// Function to fetch only parent categories
function fetchParentCategories() {
    global $conn;

    if ($conn) {
        $sql = "SELECT id, name FROM categories WHERE parent_id IS NULL ORDER BY name ASC";
        $result = $conn->query($sql);
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    } else {
        die("Database connection not established.");
    }
}

// Fetch parent categories before rendering the form
$parentCategories = fetchParentCategories();

// Update category functionality (handle POST request when editing)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_category'])) {
    $id = $_POST['category_id'];
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'] ?? NULL;

    $stmt = $conn->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
    $stmt->bind_param("sii", $name, $parent_id, $id);
    $stmt->execute();
}
?>


    <style>
        /* Same CSS as before, no changes needed here */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #2e3b4e;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .controls-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .search-input, .rows-per-page {
            padding: 8px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: auto;
        }

        .category-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .category-table th, .category-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .category-table th {
            background-color: #4CAF50;
            color: white;
        }

        .category-table tr:hover {
            background-color: #f1f1f1;
        }

        .pagination-container {
            text-align: center;
            margin-top: 20px;
        }

        .pagination-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            margin: 2px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pagination-button:hover {
            background-color: #0056b3;
        }

        .pagination-button.active {
            background-color: #4CAF50;
        }

        .form-container h2 {
            color: #2e3b4e;
            font-size: 22px;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container select {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-container button[type="submit"] {
            display: block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button[type="submit"]:hover {
            background-color: #45a049;
        }

/* Styling for the pop-up notification */
.popup {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 5px;
            color: #fff;
            display: none;
            z-index: 1000;
        }

        .popup.success {
            background-color: #4CAF50; /* Green for success */
        }

        .popup.error {
            background-color: #f44336; /* Red for error */
        }


        /* Modal styles */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Icon styling */
        .category-table td a {
            color: #007BFF;
            font-size: 20px;
            text-decoration: none;
            padding: 5px;
        }

        .category-table td a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .category-table td a i {
            margin-right: 5px;
        }

        /* Edit icon color */
        .fas.fa-edit {
            color: #4CAF50; /* Green color */
            font-size: 20px; /* Adjust size */
        }

        /* Delete icon color */
        .fas.fa-trash-alt {
            color: #F44336; /* Red color */
            font-size: 20px; /* Adjust size */
        }

        .fas {
            margin-right: 10px; /* Add space between icons */
            cursor: pointer;
        }

        .fas:hover {
            color: #007bff; /* Change color on hover */
        }
       /* Modal Container */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent background */
    padding-top: 60px; /* Space from the top */
}

/* Modal Content */
.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

/* Modal Title */
h2 {
    font-size: 22px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* Form Styling */
form {
    display: flex;
    align-items: center;
}

/* Flex container for input and select */
.form-row {
    display: flex;
    gap: 15px;
    width: 100%;
    justify-content: space-between;
}

input[type="text"],
select {
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
    
}

input[type="text"]:focus,
select:focus {
    outline-color: #4CAF50; /* Focus color */
}

/* Submit Button */
button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .modal-content {
       
        padding: 10px;
    }
    input[type="text"],
    select,
    button[type="submit"] {
        width: 100%;
    }
    .form-row {
       
        align-items: stretch;
    }
}

        
    </style>
 <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<?php
require 'navbar.php';  // Include the footer

?>
    <div class="container">
        <!-- Add New Category Form -->
        <div class="form-container">
        <h1>Category Management</h1>
    <form method="POST" action="">
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="parent_id">Parent Category:</label>
        <select id="parent_id" name="parent_id">
            <option value="">Select Parent Category</option>
            <?php
            // Generate the dropdown options for parent categories
            $categories = getCategories(new mysqli($servername, $username, $password, $dbname));
            foreach ($categories as $category) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit" name="add_category">Add Category</button>
    </form>
        </div>
        <!-- Pop-up Notification -->
    <div id="popup" class="popup"></div>

<script>
    // JavaScript to handle the pop-up notification
    const message = "<?php echo $message; ?>";
    const messageType = "<?php echo $messageType; ?>";

    if (message) {
        const popup = document.getElementById("popup");
        popup.textContent = message;
        popup.className = `popup ${messageType}`;
        popup.style.display = "block";

        // Automatically hide the pop-up after 3 seconds
        setTimeout(() => {
            popup.style.display = "none";
        }, 3000);
    }
</script>

        <hr>
        <h1>Categories</h1>
        <div class="controls-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search Categories...">
            <label for="rowsPerPage">Rows per page:</label>
            <select id="rowsPerPage" class="rows-per-page">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>

        <!-- Display categories in a single table -->
        <table class="category-table" id="categoryTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Parent Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $categories = getAllCategories();
                $counter = 1;

                foreach ($categories as $category) {
                    echo "<tr>";
                    echo "<td>" . $counter++ . "</td>";
                    echo "<td>" . $category['name'] . "</td>";
                    echo "<td>" . ($category['parent_name'] ? $category['parent_name'] : 'No Parent') . "</td>";
                    echo "<td>";
                    echo "<a href='#' class='edit-btn' data-id='" . $category['id'] . "' data-name='" . $category['name'] . "' data-parent_name='" . $category['parent_name'] . "' title='Edit'>
                            <i class='fas fa-edit'></i> <!-- Green Edit Icon -->
                          </a> | 
                          <a href='delete_category.php?id=" . $category['id'] . "' title='Delete' onclick='return confirm(\"Are you sure you want to delete this category?\")'>
                            <i class='fas fa-trash-alt'></i> <!-- Red Trash Icon -->
                          </a>";
                    echo "</td>";  
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination Buttons -->
        <div class="pagination-container" id="paginationContainer"></div>
    </div>

  <!-- Edit Category Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Category</h2>
        <form method="POST">
            <input type="hidden" id="categoryId" name="category_id">
            
            <!-- Flex container for input and select -->
            <div class="form-row">
                <input type="text" id="categoryName" name="name" placeholder="Category Name" required>
                <select id="parentId" name="parent_id">
                    <option value="">Select Parent Category</option>
                    <?php
                    if (!empty($parentCategories)) {
                        foreach ($parentCategories as $parent) {
                            echo "<option value='{$parent['id']}'>{$parent['name']}</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No Parent Categories Available</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="update_category">Update Category</button>
        </form>
    </div>
</div>

    <script>
        // Modal functionality
        const modal = document.getElementById("editModal");
        const closeModal = document.querySelector(".close");

        // Show modal when edit button is clicked
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const name = this.getAttribute("data-name");
                const parent_name = this.getAttribute("data-parent_name");

                document.getElementById("categoryId").value = id;
                document.getElementById("categoryName").value = name;

                // Set the parent category dropdown value based on the selected category
                const parentDropdown = document.getElementById("parentId");
                for (let option of parentDropdown.options) {
                    if (option.text === parent_name) {
                        option.selected = true;
                    }
                }

                modal.style.display = "block"; // Show the modal
            });
        });

        // Close the modal
        closeModal.addEventListener("click", function() {
            modal.style.display = "none";
        });

        // Close modal if the user clicks outside of the modal content
        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    </script>
<?php
require 'footer.php';  // Include the footer

?>
