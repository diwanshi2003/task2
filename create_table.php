<?php
$db = mysqli_connect('localhost', 'root', 'root', 'user_auth');

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create table
$query = "
CREATE TABLE IF NOT EXISTS user_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (mysqli_query($db, $query)) {
    echo "Table created successfully!<br>";
} else {
    echo "Error: " . mysqli_error($db) . "<br>";
}

// Sample users
$users = [
    ['john_doe', 'john@example.com', 'password123'],
    ['jane_admin', 'jane@example.com', 'adminpass'],
    ['user_test', 'test@example.com', 'test1234']
];

foreach ($users as $user) {
    [$username, $email, $plainPassword] = $user;
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    $checkQuery = "SELECT id FROM user_table WHERE username = ?";
    $stmt = mysqli_prepare($db, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 0) {
        $insertQuery = "INSERT INTO user_table (username, email, password) VALUES (?, ?, ?)";
        $insertStmt = mysqli_prepare($db, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "sss", $username, $email, $hashedPassword);
        mysqli_stmt_execute($insertStmt);
        echo "Inserted user: $username<br>";
        mysqli_stmt_close($insertStmt);
    } else {
        echo "User $username already exists.<br>";
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($db);
?>


