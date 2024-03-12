<?php
include '../../config.php';

// Check if the post_id parameter is set in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $post_id = $_POST['id'];

        $query = 'DELETE FROM posts WHERE post_id = ?';
        $stmt = $conn->prepare($query);
        $stmt->execute([$post_id]);

        // Check if the deletion was successful
        $response = [
            'status' => 'success',
            'message' => 'Post deleted successfully'
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
