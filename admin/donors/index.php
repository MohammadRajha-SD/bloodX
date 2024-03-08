<?php
include '../../config.php';
include '../helpers/helpers.php';
$pageTitle = "Donors";

ob_start();
session_start();

$post_type = "donation";
$query = 'SELECT COUNT(*) as counter_user, users.*, posts.* FROM users
    INNER JOIN posts ON users.user_id = posts.user_id
    WHERE posts.post_type = ?';

$rows_per_page = 2;
$stmt = $conn->prepare($query);
$stmt->execute([$post_type]);
$counter = $stmt->fetchColumn();
$pages = ceil($counter / $rows_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($current_page - 1) * $rows_per_page;

$donors_query = 'SELECT users.*, posts.*, blood_groups.*, statuses.*, countries.* FROM users
    INNER JOIN posts ON users.user_id = posts.user_id
    INNER JOIN blood_groups ON users.blood_group_id = blood_groups.group_id  
    INNER JOIN statuses ON users.acc_status = statuses.status_id
    INNER JOIN countries ON users.country_id = countries.country_id
    WHERE posts.post_type = ? LIMIT ?, ?';

try {
    $count = 0;
    $stmt = $conn->prepare($donors_query);
    $stmt->execute([$post_type, $start, $rows_per_page]);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>


<!-- TABLE FOR USERS -->
<section class="section">
    <div class="section-header">
        <h1>Donors </h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="../">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="">Donors</a></div>
            <div class="breadcrumb-item">Donors Details</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Donors Details</h4>
                        <div class="card-header-action">
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
                                        <th>Blood Group</th>
                                        <th>Country</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Status</th>
                                        <th>Admin</th>
                                        <th>Donated at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($counter > 0) {
                                        foreach ($result as $row) {
                                            $count += 1;
                                            $ad_query = "SELECT TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age,  DATE_FORMAT(donated_at, '%b %m-%y') AS donated FROM users WHERE user_id = ?";
                                            $stmt = $conn->prepare($ad_query);
                                            $stmt->execute([$row['user_id']]);
                                            $result = $stmt->fetch();

                                            $age = $result['age'];
                                            $donated = $result['donated'];

                                            echo '<tr>';
                                            echo '<td>' . $count . '</td>';
                                            echo '<td>' . $row["username"] . '</td>';
                                            echo '<td>' . $row["group_name"] . '</td>';
                                            echo '<td>' . $row["country_name"] . '</td>';
                                            echo '<td>' . ucwords($row["gender"]) . '</td>';
                                            echo '<td>' . $age . '</td>';
                                            echo '<td>' . setStatus($row["status_type"]) . '</td>';
                                            echo '<td>' . setAdmin($row["is_admin"]) . '</td>';
                                            echo '<td>' . $donated . '</td>';

                                            echo '<td>';
                                            echo '<div class="dropdown d-inline">';
                                            echo '<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</button>';
                                            echo '<div class="dropdown-menu">';
                                            echo '<a class="dropdown-item has-icon" href="#"><i class="fas fa-heart"></i>View</a>';
                                            echo '<a class="dropdown-item has-icon" href="edit.php?id=' . $row['user_id'] . '"><i class="fas fa-edit"></i>Edit</a>';
                                            echo '<a class="dropdown-item has-icon delete-item" href="delete.php" data-id="' . $row['user_id'] . '"><i class="fa fa-trash"></i>Delete</a>';
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
<!-- // TABLE FOR DONORS // -->
<?php
$content = ob_get_clean();
include('../layout.php');
?>