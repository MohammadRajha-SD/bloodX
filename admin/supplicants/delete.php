<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user_id parameter is set in the POST request
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        
        $query = 'DELETE FROM users WHERE user_id = ?';
        $stmt = $conn->prepare($query);
        $stmt->execute([$user_id]);

        // Check if the deletion was successful
        $response = [
            'status' => 'success',
            'message' => 'User deleted successfully'
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
?>
