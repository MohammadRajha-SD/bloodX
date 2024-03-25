<?php
include '../config.php';
include '../helpers/helpers.php';
global $conn;

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to the index page if the request method is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Validate and process form data
try {
    // Extract form data
    $username_or_email = strtolower($_POST['usernameOrEmail']);
    $password = $_POST['password'];

    // Check if email and username already exist
    $emailExists = isExistsDB($username_or_email);
    $usernameExists = isExistsDB($username_or_email, 'username');

    // If email or username already exist, redirect back with error message
    if ($emailExists || $usernameExists) {
        $query = "SELECT * FROM users WHERE username = ? or email = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$username_or_email, $username_or_email]);
        $userData = $stmt->fetch();

        $username = $userData['username'];
        $hashedPassword = $userData['passwrd'];
        $is_admin = $userData['is_admin'];

        // Verify if the entered password matches the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Set success flash message and redirect to index page 
            $_SESSION['USER'] = $userData;

            flash('success', 'Welcome Back, ' . $username);
            header('Location: ../index.php');
            exit();
        } else {
            // flash Password is incorrect
            flash('error', 'Incorrect password.');
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
    } else {
        // flash a message that username or email does not exist.
        flash('error', 'Email or username does not exist.');
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
} catch (PDOException $e) {
    // Handle database errors
    echo "Database Error: " . $e->getMessage();
    exit();
}
