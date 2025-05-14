<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .user-card {
            background: #fff;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .user-card img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<?php
session_start();

// Connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'user_auth');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Query from user_table instead of users
$sql = "SELECT id, username, email, img FROM user_table";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="user-card">';
        echo "<strong>ID:</strong> " . htmlspecialchars($row["id"]) . "<br>";
        echo "<strong>Username:</strong> " . htmlspecialchars($row["username"]) . "<br>";
        echo "<strong>Email:</strong> " . htmlspecialchars($row["email"]) . "<br>";
        if (!empty($row["img"])) {
            echo '<img src="' . htmlspecialchars($row["img"]) . '" alt="User Image"><br>';
        } else {
            echo "<em>No image uploaded</em><br>";
        }
        echo '</div>';
    }
} else {
    echo "<p>No users found.</p>";
}

$db->close();   
?> 

</body>
</html>
