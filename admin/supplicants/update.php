<?php
include '../../config.php';
include '../helpers/helpers.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['editBtn'])) {
        $dir = '../assets/uploads/';
        $old_path_image = $_POST['old_path_image'];
        $imgPath = uploadImage($_FILES['image'], $dir);

        if ($imgPath) {
            $profile_pic = $imgPath;
            deleteImage($dir, $old_path_image);
        } else {
            $profile_pic = $old_path_image;
        }

        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $birthday = $_POST['birthday'];
        $website_url = $_POST['website_url'];
        $acc_status = $_POST['acc_status'];
        $blood_group_id = $_POST['blood_group'];
        $is_admin = $_POST['is_admin'];

        $data = [
            $username, $name, $email, $phone_number,
            $gender, $birthday, $profile_pic, $website_url,
            $country, $acc_status, $blood_group_id,
            $is_admin, $user_id
        ];

        $query = <<<EOT
                    UPDATE users 
                    SET username = ?, name = ?,
                    email = ?, phone_number = ?,
                    gender = ?, birthday = ?,
                    profile_pic = ?, website_url = ?,
                    country_id = ?, acc_status = ?,
                    blood_group_id = ?, is_admin = ?
                    WHERE user_id = ?
                    EOT;

        $stmt = $conn->prepare($query);
        $stmt->execute($data);
        $_SESSION['toastr'] = [
            'status' => 'success',
            'message' => 'Updated Successfully'
        ];
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
