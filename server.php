<?php
session_start();

$db = mysqli_connect('localhost', 'root', 'root', 'user_auth');
$errors = [];

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    $username = trim(mysqli_real_escape_string($db, $_POST['username']));
    $email = trim(mysqli_real_escape_string($db, $_POST['email']));
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    // Validation
    if (empty($username)) $errors[] = "Username is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($password_1)) $errors[] = "Password is required";
    if ($password_1 !== $password_2) $errors[] = "Passwords do not match";

    // Check existing user
    $check = "SELECT * FROM user_table WHERE username = ? OR email = ? LIMIT 1";
    $stmt = mysqli_prepare($db, $check);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) $errors[] = "Username already exists";
        if ($user['email'] === $email) $errors[] = "Email already exists";
    }

    // Register if no errors
    if (empty($errors)) {
        $hashedPassword = password_hash($password_1, PASSWORD_DEFAULT);
        $query = "INSERT INTO user_table (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
        mysqli_stmt_execute($stmt);

        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        header('Location: register.php');
        exit();
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = trim(mysqli_real_escape_string($db, $_POST['username']));
    $password = $_POST['password'];

    $query = "SELECT * FROM user_table WHERE username = ? LIMIT 1";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header('Location: dashboard.php');
        exit();
    } else {
        $_SESSION['errors'] = ["Invalid username or password"];
        header('Location: login.php');
        exit();
    }
}
?>






