<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

// Logout functionality
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* Ensure background image path is correct, adjust if needed */
        body {
            font-family: Arial, sans-serif;
            background: url('image/dashboard.jpg') no-repeat center center fixed; /* Check path here */
            background-size: cover;
            padding: 50px;
            text-align: center;
            color: #fff; /* White text */
        }

        /* Dashboard container styling */
        .dashboard {
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            padding: 30px;
            margin: auto;
            width: 50%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333; /* Dark text for visibility */
        }

        /* Logout button styling */
        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout:hover {
            background: #c0392b;
        }

        /* Welcome message styling */
        .welcome-message {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p class="welcome-message">You have successfully logged in.</p>

        <!-- Logout button -->
        <a href="dashboard.php?logout=true" class="logout">Logout</a>
    </div>
</body>
</html>





