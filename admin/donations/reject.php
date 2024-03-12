<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user_id parameter is set in the POST request
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $s_id = null;

        $query = 'SELECT * FROM statuses';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $rds = $stmt->fetchAll();

        foreach ($rds as $rd) {
            if (strtolower($rd['status_type']) == 'rejected') {
                $s_id = $rd['status_id'];
            }
        }

        $query = 'UPDATE posts SET post_status = ? WHERE post_id = ?';
        $stmt = $conn->prepare($query);
        $stmt->execute([$s_id, $id]);

        // Check if the approving was successful
        $response = [
            'status' => 'success',
            'message' => 'Post Rejected successfully'
        ];
    } else {
        $response = [
            'status' => 'error',
        ];
    }

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
