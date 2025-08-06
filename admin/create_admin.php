<?php
require 'db_connect.php';  // Database connection
require 'header.php';      // Include the header
require 'sidebar.php';     // Include the sidebar

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    // Validate form fields
    if (empty($username) || empty($email) || empty($address) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required!');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address!');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Check if the username or email already exists
        $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Username or Email already exists! Please choose another.');</script>";
        } else {
            // Insert new admin into the database
            $insert_sql = "INSERT INTO users (username, email, address, password, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param('ssss', $username, $email, $address, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Admin account created successfully!'); window.location.href='admin/dashboard.php';</script>";
            } else {
                echo "<script>alert('Error: Unable to create account. Please try again later.');</script>";
            }
        }
        $stmt->close();
    }
}
?>

<title>Create Admin Account</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        color: #333;
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
        max-width: 600px;
    }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
        color: #555;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea,
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    button {
        background-color: #5cb85c;
        color: white;
        font-size: 18px;
        cursor: pointer;
    }
    button:hover {
        background-color: #4cae4c;
    }
</style>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
<?php
require './navbar.php';  // Include the footer
?>
    <h1>Create Admin Account</h1>
    <div class="form-container">
        <form action="" method="POST" id="adminForm">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required placeholder="Enter username">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required placeholder="Enter email">

            <label for="address">Address:</label>
            <!-- Removed "display: none;" to ensure the address field is visible -->
            <textarea name="address" id="address" rows="3" required placeholder="Enter address"></textarea>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required placeholder="Enter password" minlength="6">

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required placeholder="Confirm password" minlength="6">

            <button type="submit">Create Admin</button>
        </form>
    </div>


<script>
    // Client-side validation
    document.getElementById('adminForm').addEventListener('submit', function(e) {
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm_password');

        if (passwordField.value !== confirmPasswordField.value) {
            e.preventDefault();
            alert('Passwords do not match!');
            confirmPasswordField.focus();
        }
    });
</script>

<?php
require 'footer.php';  // Include the footer
?>
