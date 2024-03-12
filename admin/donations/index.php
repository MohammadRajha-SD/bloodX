<?php
include '../../config.php';
include '../helpers/helpers.php';
$pageTitle = "Donations";

ob_start();
session_start();

$post_type = "donation";
$query = 'SELECT COUNT(*) as counter_post FROM posts WHERE post_type = ?';

$rows_per_page = 2;
$stmt = $conn->prepare($query);
$stmt->execute([$post_type]);
$counter = $stmt->fetchColumn();
$pages = ceil($counter / $rows_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($current_page - 1) * $rows_per_page;

$donations_query = 'SELECT users.*, posts.*, blood_groups.*, blood_processes.*, statuses.*, countries.*
    FROM posts
    INNER JOIN users ON posts.user_id = users.user_id
    INNER JOIN blood_groups ON posts.blood_group_id = blood_groups.group_id
    INNER JOIN blood_processes ON posts.blood_process_id = blood_processes.process_id
    INNER JOIN statuses ON posts.post_status = statuses.status_id
    INNER JOIN countries ON users.country_id = countries.country_id
    WHERE posts.post_type = ? LIMIT ?, ?';

try {
    $count = 0;
    $stmt = $conn->prepare($donations_query);
    $stmt->execute([$post_type, $start, $rows_per_page]);
    $result = $stmt->fetchAll();

    // fetch post's diseases 
    $ds_query = 'SELECT  post_diseases.*, diseases.* FROM posts
      INNER JOIN post_diseases ON posts.post_id = post_diseases.post_id
      INNER JOIN diseases ON post_diseases.disease_id = diseases.disease_id
      WHERE posts.post_id = ?';
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!-- table for donation posts -->
<section class="section">
    <div class="section-header">
        <h1>Donations </h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="../">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="../donations/">Donations</a></div>
            <div class="breadcrumb-item">Donation Posts Details</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Donation Posts Details</h4>
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
                                        <th>Owner</th>
                                        <th>Diseases</th>
                                        <th>Blood Group</th>
                                        <th>Blood Process</th>
                                        <th>Unit (ML)</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <!-- <th>Created at</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($counter > 0) {
                                        foreach ($result as $row) {
                                            $count += 1;
                                            $date_query = "SELECT DATE_FORMAT(post_created_at, '%b %d-%y') AS created FROM posts WHERE post_id = ?";
                                            $stmt = $conn->prepare($date_query);
                                            $stmt->execute([$row['post_id']]);
                                            $created = $stmt->fetchColumn();

                                            $stmt = $conn->prepare($ds_query);
                                            $stmt->execute([$row['post_id']]);
                                            $diseases = $stmt->fetchAll();

                                            echo '<tr>';
                                            echo '<td>' . $count . '</td>';
                                            echo '<td>' . strtolower($row['username']) . '</td>';
                                            echo '<td >';
                                            if (count($diseases) > 0) {
                                                echo '<div class="dropdown mr-2 dropbottom">';
                                                echo '<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Diseases</button>';
                                                echo '<div class="dropdown-menu">';
                                                foreach ($diseases as $disease) {
                                                    echo '<a class="dropdown-item text-danger has-icon" href="#"><i class="fas fa-tint"></i>' . ucwords($disease['disease_name']) .  '</a>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            } else {
                                                echo '<span class="badge badge-success" ><i class="fas fa-check mr-2"></i>No Diseases</span>';
                                            }
                                            echo '</td>';
                                            echo '<td>' . ucwords($row['group_name']) . '</td>';
                                            echo '<td>' . ucwords($row['process_name']) . '</td>';
                                            echo '<td>' . $row["post_blood_unit"] . '</td>';
                                            echo '<td>' . ucwords($row["post_city"]) . '</td>';
                                            echo '<td>' . setStatus($row['status_type']) . '</td>';
                                            // echo '<td>' . $created . '</td>';
                                            echo '<td>';
                                            echo '<div class="d-flex">';
                                            echo '<div class="dropdown  mr-2">';
                                            echo '<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</button>';
                                            echo '<div class="dropdown-menu">';
                                            echo '<a class="dropdown-item text-info has-icon" href="#"><i class="fas fa-heartbeat"></i>View</a>';
                                            echo '<a class="dropdown-item text-success has-icon" href="edit.php?id=' . $row['post_id'] . '"><i class="fas fa-edit"></i>Edit</a>';
                                            echo '<a class="dropdown-item text-danger has-icon delete-item" href="delete.php" data-id="' . $row['post_id'] . '"><i class="fa fa-trash"></i>Delete</a>';
                                            echo '</div>';
                                            echo '</div>';
                                            if ($row['status_type'] == 'pending') {
                                                echo '<div class="dropdown ">';
                                                echo '<button class="btn-sm btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</button>';
                                                echo '<div class="dropdown-menu">';
                                                echo '<a class="dropdown-item text-success has-icon delete-item" href="approve.php" data-id="' . $row['post_id'] . '"><i class="fas fa-check"></i>Approve</a>';
                                                echo '<a class="dropdown-item text-danger  has-icon delete-item"  href="reject.php" data-id="' . $row['post_id'] . '"><i class="fas fa-times"></i>Reject</a>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
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
<!-- table for donation posts -->

<?php
$content = ob_get_clean();
include('../layout.php');
