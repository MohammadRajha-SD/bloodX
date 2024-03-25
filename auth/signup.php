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

// Store form data in session for validation
$_SESSION['OLD_DATA_FRONTEND'] = $_POST;

// Validate and process form data
try {
    // Extract form data
    $name = $_POST['name'];
    $diseases = $_POST['diseases'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['passwrd'];
    $phone_number = $_POST['phone'];
    $gender = $_POST['gender'];
    $country_id = $_POST['country'];
    $birthday = $_POST['birthday'];
    $blood_group_id = $_POST['blood_group_id'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if email and username already exist
    $emailExists = isExistsDB($email);
    $usernameExists = isExistsDB($username, 'username');

    // If email or username already exist, redirect back with error message
    if ($emailExists || $usernameExists) {
        flash('error', 'Email or username already exists.');
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // Insert user data into the database
    $query = 'INSERT INTO users (
        name, username, email, passwrd,
        phone_number, gender,
        country_id, birthday,
        blood_group_id
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';

    $stmt = $conn->prepare($query);
    $stmt->execute([
        $name, $username, $email,
        $hashedPassword, $phone_number, $gender,
        $country_id, $birthday, $blood_group_id
    ]);

    $user_id = $conn->lastInsertId();

    // Insert diseases associated with the user
    foreach ($diseases as $disease_id) {
        try {
            $query = 'INSERT INTO user_diseases (user_id, disease_id) VALUES (?, ?)';
            $stmt = $conn->prepare($query);
            $stmt->execute([$user_id, $disease_id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            // Handle the error appropriately, such as logging it or displaying a user-friendly message
        }
    }

    // Unset old form data from session
    unset($_SESSION['OLD_DATA_FRONTEND']);
    $_SESSION['USER'] = $_POST;

    // Set success flash message and redirect to index page
    flash('success', 'Welcome, ' . $username);
    header('Location: ../index.php');
    exit();
} catch (PDOException $e) {
    // Handle database errors
    echo "Database Error: " . $e->getMessage();
    exit();
}
