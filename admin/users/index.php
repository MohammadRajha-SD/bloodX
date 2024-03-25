<?php
include '../../config.php';
include '../helpers/helpers.php';
$pageTitle = "Users";
ob_start();
session_start();


$query = 'SELECT COUNT(*) as counter_user FROM users';

$rows_per_page = 2;
$stmt = $conn->prepare($query);
$stmt->execute();
$counter = $stmt->fetchColumn();

$pages = ceil($counter / $rows_per_page);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($current_page - 1) * $rows_per_page;


$users_query = 'SELECT users.*, blood_groups.*, statuses.*, countries.*
FROM users
    INNER JOIN blood_groups ON users.blood_group_id = blood_groups.group_id  
    INNER JOIN statuses ON users.acc_status = statuses.status_id
    INNER JOIN countries ON users.country_id = countries.country_id  
ORDER BY users.user_id DESC
LIMIT ?, ?';

// fetch user's diseases 
$ds_query = 'SELECT user_diseases.*, diseases.* FROM users
 INNER JOIN user_diseases ON users.user_id = user_diseases.user_id
 INNER JOIN diseases ON user_diseases.disease_id = diseases.disease_id
 WHERE users.user_id = ?';

try {
    $count = 0;
    $stmt = $conn->prepare($users_query);
    $stmt->execute([$start, $rows_per_page]);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!-- table for users -->
<section class="section">
    <div class="section-header">
        <h1>Users </h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="../">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="">Users</a></div>
            <div class="breadcrumb-item">Users Details</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Users Details</h4>
                        <div class="card-header-action">
                            <a href="create.php" class="btn btn-warning"><i class="fas fa-plus"></i> New User</a>
                            <a href="<?= '../'; ?>" class="btn btn-primary">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Username</th>
                                        <th>Diseases</th>
                                        <th>Blood Group</th>
                                        <th>Country</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Status</th>
                                        <th>Admin</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($counter > 0) {
                                        foreach ($result as $row) {
                                            $count += 1;
                                            $age_query = "SELECT TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age FROM users WHERE user_id = ?";
                                            $stmt = $conn->prepare($age_query);
                                            $stmt->execute([$row['user_id']]);
                                            $age = $stmt->fetchColumn();

                                            $stmt = $conn->prepare($ds_query);
                                            $stmt->execute([$row['user_id']]);
                                            $diseases = $stmt->fetchAll();

                                            echo '<tr>';
                                            echo '<td>' . $count . '</td>';
                                            echo '<td>' . $row["username"] . '</td>';
                                            echo '<td >';
                                            if (count($diseases) > 0) {
                                                echo '<div class="dropdown mr-2 dropbottom">';
                                                echo '<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Diseases</button>';
                                                echo '<div class="dropdown-menu">';
                                                foreach ($diseases as $disease) {
                                                    echo '<a class="dropdown-item text-danger has-icon" href="#"><i class="fas fa-tint"></i>' . $disease['disease_name'] .  '</a>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            } else {
                                                echo '<span class="badge badge-success" ><i class="fas fa-check mr-2"></i>No Diseases</span>';
                                            }
                                            echo '</td>';
                                            echo '<td>' . $row["group_name"] . '</td>';
                                            echo '<td>' . $row["country_name"] . '</td>';
                                            echo '<td>' . ucwords($row["gender"]) . '</td>';
                                            echo '<td>' . $age . '</td>';
                                            echo '<td>' . setStatus($row["status_type"]) . '</td>';
                                            echo '<td>' . setAdmin($row["is_admin"]) . '</td>';

                                            echo '<td>';
                                            echo '<div class="dropdown d-inline">';
                                            echo '<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</button>';
                                            echo '<div class="dropdown-menu">';
                                            echo '<a class="dropdown-item has-icon text-info" href="#"><i class="fas fa-heartbeat"></i>View</a>';
                                            echo '<a class="dropdown-item has-icon text-success" href="edit.php?id=' . $row['user_id'] . '"><i class="fas fa-edit"></i>Edit</a>';
                                            echo '<a class="dropdown-item has-icon text-danger delete-item" href="delete.php" data-id="' . $row['user_id'] . '" data-image="' . $row['profile_pic'] . '"><i class="fa fa-trash"></i>Delete</a>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</td>';
                                            echo "</tr>";
                                        }
                                    } else {
                                        // If no records are found, display a message
                                        echo '<tr><td class="text-center font-weight-bold" colspan="10">No records found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <?php $counter > 0 ? include_once '../pagination.php' : ''; ?>
                </div>
            </div>
        </div>
</section>
<!-- // TABLE FOR USERS // -->
<?php
$content = ob_get_clean();
include('../layout.php');
?>