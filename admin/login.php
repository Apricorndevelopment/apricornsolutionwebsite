<?php
// Include the database connection
include 'db_connect.php';
session_start();

$error = ""; // To store error messages
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // If logged in, redirect to the admin dashboard
    header("Location: dashboard.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputUsername = htmlspecialchars($_POST['username']);
    $inputPassword = $_POST['password']; // Plain password from form input

    // Query to fetch user by username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($inputPassword, $user['password'])) {
            // Password is correct; create session
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            padding: 0 15px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            width: 100%;
            max-width: 322px;
            background: #fff;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            padding: 25px;
            border-radius: 10px;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .login-key {
            font-size: 60px;
            line-height: 60px;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
           
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .login-title {
            font-size: 24px;
            letter-spacing: 1px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .login-form {
            margin-top: 25px;
            text-align: left;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            background-color: #f5f5f5;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-weight: bold;
            outline: 0;
            margin-bottom: 20px;
            color: #555;
            padding: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            border-color: #2575fc;
            background-color: #fff;
        }

        label {
            font-size: 14px;
            color: #666;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-outline-primary {
            border: 2px solid #2575fc;
            color: #2575fc;
            border-radius: 25px;
            font-weight: bold;
            letter-spacing: 1px;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background: transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-outline-primary:hover {
            background-color: #2575fc;
            color: #fff;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .login-box {
                padding: 20px;
            }

            .login-key {
                font-size: 50px;
                line-height: 50px;
            }

            .login-title {
                font-size: 20px;
            }

            input[type=text],
            input[type=password] {
                font-size: 14px;
            }

            .btn-outline-primary {
                font-size: 14px;
                padding: 8px;
            }
        }

        @media (max-width: 576px) {
            .login-key {
                font-size: 40px;
                line-height: 40px;
            }

            .login-title {
                font-size: 18px;
            }

            .btn-outline-primary {
                font-size: 12px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="login-box">
        <div class="login-key">
            <i class="fa fa-key" aria-hidden="true"></i>
        </div>
        <div class="login-title">
            ADMIN PANEL
        </div>

        <div class="login-form">
            <?php if (!empty($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label>USERNAME</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>PASSWORD</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-outline-primary">LOGIN</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
