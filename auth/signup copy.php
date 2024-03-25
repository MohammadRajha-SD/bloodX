<?php
include '../config.php';
include '../helpers/helpers.php';
global $conn;
// Check if session is already started
if (session_status() === PHP_SESSION_DISABLED) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['OLD_DATA_FRONTEND'] = $_POST;
    try {
        $name = $_POST['name'];
        $diseases = $_POST['diseases'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwrd = $_POST['passwrd'];
        $phone_number = $_POST['phone'];
        $gender = $_POST['gender'];
        $country_id = $_POST['country'];
        $birthday = $_POST['birthday'];
        $blood_group_id = $_POST['blood_group_id'];

        // Hash the password
        $hashedPassword = password_hash($passwrd, PASSWORD_BCRYPT);

        $data = [
            $name, $username,
            $email, $hashedPassword,
            $phone_number, $gender,
            $country_id, $birthday,
            $blood_group_id
        ];

        $emailChecked = isExistsDB($email);
        $usernameChecked = isExistsDB($username, 'username');

        if ($emailChecked && $usernameChecked) {
            $_SESSION['USERNAME'] = $username;

            $query = 'INSERT INTO users (
                name, username, email, passwrd,
                phone_number, gender,
                country_id, birthday,
                blood_group_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $stmt = $conn->prepare($query);
            $stmt->execute($data);

            $user_id = $conn->lastInsertId();
            foreach ($diseases as $disease_id) {
                $query = 'INSERT INTO user_diseases (user_id, disease_id) VALUES (?, ?)';
                $stmt = $conn->prepare($query);
                $stmt->execute([$user_id, $disease_id]);
            }
            unset($_SESSION['OLD_DATA_FRONTEND']);

            flash('success', 'Welcome, ' . $username);
            header('Location: index.php');
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
} else {
    header('Location: index.php');
}
