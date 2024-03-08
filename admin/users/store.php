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
            $profile_pic = $imgPath;
        } else {
            $profile_pic = $_SESSION['DEFAULT_IMAGE_PATH'];
        }

        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwrd = $_POST['passwrd'];
        $phone_number = $_POST['phone'];
        $gender = $_POST['gender'];
        $country_id = $_POST['country'];
        $birthday = $_POST['birthday'];
        $profile_pic = $profile_pic;
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
            $query = <<<EOT
                    INSERT INTO users(
                        name, username, email, passwrd, 
                        phone_number, gender, country_id, birthday, 
                        profile_pic, website_url, 
                        acc_status, blood_group_id, is_admin
                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);
                EOT;

            $stmt = $conn->prepare($query);
            $stmt->execute($data);

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
