<?php
include '../../config.php';
include '../helpers/helpers.php';

session_start();

/* echo '<td>'. strtolower($row['username']) .'</td>';
echo '<td>'. ucwords($row['group_name']). '</td>';
echo '<td>'. ucwords($row['process_name']) .'</td>';
echo '<td>' . $row["post_blood_unit"] . '</td>';
echo '<td>'. ucwords($row["post_city"]). '</td>';
echo '<td>'. setStatus($row['status_type']) .'</td>'; */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['editBtn'])) {
        $post_id = $_POST['post_id'];
        $username = $_POST['username'];
        $group_name = $_POST['group_name'];
        $process_name = $_POST['process_name'];
        $blood_unit = $_POST['post_blood_unit'];
        $post_type = $_POST['post_type'];
        $city = $_POST['post_city'];
        $status_type = $_POST['status_type'];

        $data = [
            $username, $group_name, $process_name, $blood_unit,
            $city, $status_type, $post_id
        ];

        $query = ' UPDATE posts SET 
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
    }
} else {
    header('Location: index.php');
}
