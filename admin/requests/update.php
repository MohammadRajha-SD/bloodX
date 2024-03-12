<?php
include '../../config.php';
include '../helpers/helpers.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $diseases = $_POST['diseases'];

    $post_status = $_POST['status'];
    $blood_group_id = $_POST['blood_group'];
    $blood_process_id = $_POST['blood_process'];
    $post_type = $_POST['post_type'];
    $post_blood_unit = $_POST['blood_unit'];
    $post_city = $_POST['city'];

    $query = 'DELETE FROM post_diseases WHERE post_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->execute([$post_id]);

    foreach ($diseases as $disease_id) {
        $query = 'INSERT INTO post_diseases (post_id, disease_id) VALUES (?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->execute([$post_id, $disease_id]);
    }

    $data = [
        $post_status,
        $blood_group_id,
        $blood_process_id,
        $post_type,
        $post_city,
        $post_blood_unit,
        $post_id
    ];

    $query = 'UPDATE posts SET 
    post_status = ?,
    blood_group_id = ?, 
    blood_process_id = ?,
    post_type = ?,
    post_city = ?,
    post_blood_unit = ?
    WHERE post_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->execute($data);

    flash('success', 'Updated Successfully.');
    header('Location: index.php');
} else {
    header('Location: index.php');
}
