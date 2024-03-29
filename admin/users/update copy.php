<?php
include '../../config.php';
include '../helpers/helpers.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dir = '../assets/uploads/';
    $old_path_image = $_POST['old_path_image'];
    $imgPath = uploadImage($_FILES['image'], $dir);

    if ($imgPath) {
        $profile_pic = $imgPath;
        deleteImage($dir, $old_path_image);
    } else {
        $profile_pic = $old_path_image;
    }

    $user_id    = $_POST['user_id'];
    $diseases = $_POST['diseases'];
    $name       = $_POST['name'];
    $username   = strtolower($_POST['username']);
    $email      = strtolower($_POST['email']);
    $phone_number = $_POST['phone'];
    $gender     = $_POST['gender'];
    $country    = $_POST['country'];
    $birthday   = $_POST['birthday'];
    $website_url = $_POST['website_url'];
    $acc_status  = $_POST['acc_status'];
    $blood_group_id = $_POST['blood_group'];
    $is_admin       = $_POST['is_admin'];

    $emailChecked = isExistsDB($email, 'email', true, $user_id);
    $usernameChecked = isExistsDB($username, 'username', true, $user_id);

    if ($emailChecked && $usernameChecked) {
        $query = 'DELETE FROM user_diseases WHERE user_id = ?';
        $stmt = $conn->prepare($query);
        $stmt->execute([$user_id]);

        foreach ($diseases as $disease_id) {
            $query = 'INSERT INTO user_diseases (user_id, disease_id) VALUES (?, ?)';
            $stmt = $conn->prepare($query);
            $stmt->execute([$user_id, $disease_id]);
        }

        $data = [
            $username, $name, $email, $phone_number,
            $gender, $birthday, $profile_pic, $website_url,
            $country, $acc_status, $blood_group_id,
            $is_admin, $user_id
        ];

        $query = 'UPDATE users SET
        username = ?, name = ?,
        email = ?, phone_number = ?,
        gender = ?, birthday = ?,
        profile_pic = ?, website_url = ?,
        country_id = ?, acc_status = ?,
        blood_group_id = ?, is_admin = ?
        WHERE user_id = ?';

        $stmt = $conn->prepare($query);
        $stmt->execute($data);

        flash('success', 'Updated Successfully.');
        header('Location: index.php');
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    header('Location: index.php');
}
