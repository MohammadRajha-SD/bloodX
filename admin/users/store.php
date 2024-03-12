<?php
include '../../config.php';
include '../helpers/helpers.php';
session_start();

// Make $conn global
global $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['OLD_DATA'] = $_POST;
    try {
        $dir = '../assets/uploads/';
        $imgPath = uploadImage($_FILES['image'], $dir);

        if ($imgPath) {
            $img = $imgPath;
        } else {
            $img = $_SESSION['DEFAULT_IMAGE_PATH'];
        }

        $name = $_POST['name'];
        $diseases = $_POST['diseases'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwrd = $_POST['passwrd'];
        $phone_number = $_POST['phone'];
        $gender = $_POST['gender'];
        $country_id = $_POST['country'];
        $birthday = $_POST['birthday'];
        $profile_pic = $img;
        $website_url = $_POST['website_url'];
        $acc_status = $_POST['acc_status'];
        $blood_group_id = $_POST['blood_group'];
        $is_admin = $_POST['is_admin'];

        // Hash the password
        $hashedPassword = password_hash($passwrd, PASSWORD_BCRYPT);

        $data = [
            $name, $username,
            $email, $hashedPassword,
            $phone_number, $gender,
            $country_id, $birthday,
            $profile_pic, $website_url,
            $acc_status, $blood_group_id,
            $is_admin
        ];

        $emailChecked = isExistsDB($email);
        $usernameChecked = isExistsDB($username, 'username');

        if ($emailChecked && $usernameChecked) {
            $query = 'INSERT INTO users(
                        name, username, email, passwrd, 
                        phone_number, gender, country_id, birthday, 
                        profile_pic, website_url, 
                        acc_status, blood_group_id, is_admin
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $stmt = $conn->prepare($query);
            $stmt->execute($data);

            $user_id = $conn->lastInsertId();
            foreach ($diseases as $disease_id) {
                $query = 'INSERT INTO user_diseases (user_id, disease_id) VALUES (?, ?)';
                $stmt = $conn->prepare($query);
                $stmt->execute([$user_id, $disease_id]);
            }
            unset($_SESSION['OLD_DATA']);

            flash('success', 'Created Successfully.');
            header('Location: index.php?page=1');
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
