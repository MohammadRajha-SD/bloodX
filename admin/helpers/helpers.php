<?php
function asset($path)
{
    if (!isset($path)) {
        return $_SESSION['LAYOUT_PATH'];
    }

    return $_SESSION['LAYOUT_PATH'] . $path;
}

function setActive($paths)
{
    if (is_array($paths)) {
        foreach ($paths as $path) {
            if ($_SERVER['PHP_SELF'] == $path) {
                return 'active';
            }
        }
    }
}

function setStatus($status)
{
    $cases = [
        'success' => ['active', 'online', 'approved'],
        'danger'  => ['suspended', 'rejected'],
        'info' => ['inactive', 'offline'],
        'warning' => ['pending']
    ];

    foreach ($cases as $key => $value) {
        if (in_array($status, $value)) {
            return '<div class="badge badge-' . $key . '">' . ucwords($status) . '</div>';
        }
    }
}

function setAdmin($admin)
{
    if ($admin) {
        return '<div class="badge badge-success"><i class="fas fa-check"></i></div>';
    } else {
        return '<div class="badge badge-danger"><i class="fas fa-times"></i></div>';
    }
}
function checkImageIfExists($dir, $path)
{
    if (file_exists($dir . $path)) {
        return $dir . $path;
    } else {
        return $dir . $_SESSION['DEFAULT_IMAGE_PATH'];
    }
}

function uploadImage($image, $path)
{
    // Check if file was uploaded without errors
    if (isset($image) && $image["error"] == 0) {
        $FName = $image["name"]; // The name of the uploaded file
        $FTmp  = $image["tmp_name"]; // The temporary file path on the server

        // Move the uploaded file to the desired location
        $new_path = uniqid() . '_image.' . pathinfo($FName, PATHINFO_EXTENSION); // Generate a unique filename

        if (move_uploaded_file($FTmp, $path . $new_path)) {
            return $new_path;
        } else {
            return NULL;
        }
    }
}

function deleteImage($dir, $path)
{
    // Check if the file exists before attempting to delete it
    if (file_exists($dir . $path) && $path != $_SESSION['DEFAULT_IMAGE_PATH']) {
        // Attempt to delete the file
        unlink($dir . $path);
    }
}
function flash($status, $message)
{
    $_SESSION['toastr'][] = [
        'status' => $status,
        'message' => $message
    ];
    return NULL;
}

function isExistsDB($name, $field = 'email', $all = false, $id = 0)
{
    global $conn; // Access the global $conn variable

    $validFields = ['email', 'username']; // fields needed to check

    if (!in_array($field, $validFields)) {
        // Field is not valid, return false
        return false;
    }
    if ($all) {
        $query = "SELECT COUNT(*) AS users_count FROM users WHERE $field = ? and user_id != $id";
    } else {
        $query = "SELECT COUNT(*) AS users_count FROM users WHERE $field = ?";
    }
    $stmt = $conn->prepare($query);
    $stmt->execute([$name]);
    $result = $stmt->fetchColumn();

    return $result > 0 ? flash('error', ucwords($field) . " already exists.") : strtolower($name);
}

function old($name)
{
    if (isset($_SESSION['OLD_DATA'])) {
        return htmlspecialchars($_SESSION['OLD_DATA'][$name]);
    } else {
        return '';
    }
}
