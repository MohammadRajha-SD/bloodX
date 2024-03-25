<?php
// Include necessary files
include '../../config.php';
include '../helpers/helpers.php';

// Start session
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directory for image uploads
    $uploadDirectory = '../assets/uploads/';

    // Retrieve old image path
    $oldImagePath = $_POST['old_path_image'];

    // Upload new image and handle image update
    $newImagePath = uploadImage($_FILES['image'], $uploadDirectory);
    $profilePic = $newImagePath ? $newImagePath : $oldImagePath;

    // Retrieve and sanitize input data
    $userId = $_POST['user_id'];
    $diseases = isset($_POST['diseases']) ? $_POST['diseases'] : [];
    $name = $_POST['name'];
    $username = strtolower($_POST['username']);
    $email = strtolower($_POST['email']);
    $phoneNumber = $_POST['phone'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $birthday = $_POST['birthday'];
    $websiteUrl = $_POST['website_url'];
    $accStatus = $_POST['acc_status'];
    $bloodGroupId = $_POST['blood_group'];
    $isAdmin = $_POST['is_admin'];

    // Check if email and username already exist
    $emailExists = isExistsDB($email, 'email', true, $userId);
    $usernameExists = isExistsDB($username, 'username', true, $userId);

    if (!$emailExists || !$usernameExists) {
        // Delete existing user diseases
        $deleteQuery = 'DELETE FROM user_diseases WHERE user_id = ?';
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->execute([$userId]);

        // Insert new user diseases
        foreach ($diseases as $diseaseId) {
            $insertQuery = 'INSERT INTO user_diseases (user_id, disease_id) VALUES (?, ?)';
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->execute([$userId, $diseaseId]);
        }

        // Update user information
        $updateQuery = 'UPDATE users SET
            username = ?, name = ?,
            email = ?, phone_number = ?,
            gender = ?, birthday = ?,
            profile_pic = ?, website_url = ?,
            country_id = ?, acc_status = ?,
            blood_group_id = ?, is_admin = ?
            WHERE user_id = ?';

        $updateData = [
            $username, $name, $email, $phoneNumber,
            $gender, $birthday, $profilePic, $websiteUrl,
            $country, $accStatus, $bloodGroupId,
            $isAdmin, $userId
        ];

        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->execute($updateData);

        // Set success flash message and redirect
        flash('success', 'Updated Successfully.');
        header('Location: index.php');
        exit();
    } else {
        // Redirect back if email or username already exists
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    // Redirect if request method is not POST
    header('Location: index.php');
    exit();
}
