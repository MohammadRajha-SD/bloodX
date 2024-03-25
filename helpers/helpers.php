<?php
session_start();

function asset($path)
{
    if (!isset($path)) {
        return $_SESSION['LAYOUT_PATH_FRONTEND'];
    }

    return $_SESSION['LAYOUT_PATH_FRONTEND'] . $path;
}

function old($name)
{
    if (isset($_SESSION['OLD_DATA_FRONTEND'])) {
        if (is_array($_SESSION['OLD_DATA_FRONTEND'])) {
            return $_SESSION['OLD_DATA_FRONTEND'][$name];
        }
        return htmlspecialchars($_SESSION['OLD_DATA_FRONTEND'][$name]);
    } else {
        return '';
    }
}

function isExistsDB($name, $field = 'email', $isSpecific = false, $id = 0)
{
    global $conn; // Access the global $conn variable
    $validFields = ['email', 'username']; // fields needed to check

    if (!in_array($field, $validFields)) {
        // Field is not valid, return false
        return false;
    }

    if ($isSpecific) {
        $query = "SELECT COUNT(*) AS users_count FROM users WHERE $field = ? and user_id != $id";
    } else {
        $query = "SELECT COUNT(*) AS users_count FROM users WHERE $field = ?";
    }

    $stmt = $conn->prepare($query);
    $stmt->execute([$name]);
    $result = $stmt->fetchColumn();

    return $result > 0;
}

function isAdmin($field)
{
    if (in_array(strtolower($field), $_SESSION['ADMIN_ARRAY'])) {
        return true;
    } else {
        return false;
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
