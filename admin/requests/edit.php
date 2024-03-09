<?php
include '../../config.php';
include '../helpers/helpers.php';

$pageTitle = "Donation Post";
ob_start();
session_start();


if (isset($_GET['id']) && $_GET['id'] != '') {
    $post_types = [];
    try {
        if (isset($_SESSION['POST_TYPES'])) {
            $post_types = $_SESSION['POST_TYPES'];
        }

        // Fetch users table from database
        $post_id = $_GET['id'];

        $query = 'SELECT users.*, posts.* , post_diseases.*, diseases.* FROM posts
        INNER JOIN users ON users.user_id = posts.user_id
        INNER JOIN post_diseases ON posts.post_id = post_diseases.post_id
        INNER JOIN diseases ON post_diseases.disease_id = diseases.disease_id
        WHERE posts.post_id = ?';

        $stmt = $conn->prepare($query);
        $stmt->execute([$post_id]);
        $rd = $stmt->fetchAll()[0];
        print_r($rd);

        // Fetch blood groups table from database
        $query = 'SELECT * FROM blood_groups';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $blood_groups_rds = $stmt->fetchAll();

        $query = 'SELECT * FROM blood_processes';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $blood_processes_rds = $stmt->fetchAll();

        // Fetch countries table from database
        $query = 'SELECT * FROM countries';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $countries = $stmt->fetchAll();

        // Fetch statuses table from database
        $query = 'SELECT * FROM statuses';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $statuses = $stmt->fetchAll();

        // Fetch Diseases table from database
        $query = 'SELECT * FROM diseases';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $diseases = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    header('Location: index.php');
}
?>
<!-- User Information:
    user_id: 11
    username: elias
    name: Mohammad Amir
    email: mohammadrajha2aaqqaa@gmail.com
    (and other user-related fields)
    Post Information:

    post_id: 1
    post_status: 4
    (and other post-related fields)
    Disease Information (First Disease):

    disease_id: 1
    disease_name: Cant Make Sex
    Disease Information (Second Disease):

    disease_id: 2
    disease_name: Cancer -->
<section class="section">
    <div class="section-header">
        <h1>Donation Post</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="../">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="../donations/">Donation Post</a></div>
            <div class="breadcrumb-item">Edit Donation Post</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Donation Post : <?= $rd['username'] ?></h4>
                        <div class="card-header-action">
                            <a href="<?= '../donations'; ?>" class="btn btn-primary">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="update.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="diseases">Diseases</label>
                                        <select class="form-control selectric" name="diseases[]" id="diseases" multiple>
                                            <option value="" disabled>Select</option>
                                            <?php foreach ($diseases as $disease) : ?>
                                                <option value="<?= $disease['disease_id'] ?>" <?= $disease['disease_id'] ==  $rd['disease_id'] ? 'selected' : '' ?>><?= $disease['disease_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="blood_unit">Blood Unit<code> (ML)</code></label>
                                        <input type="number" class="form-control" min="0" id="blood_unit" name="blood_unit" placeholder="10" value="<?= $rd['post_blood_unit'] ?>">
                                    </div>
                                </div>

                                <!-- blood processes && blood groups start -->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="blood_group">Blood Group</label>
                                        <select class="form-control selectric" name="blood_group" id="blood_group">
                                            <option value="" disabled>Select</option>
                                            <?php foreach ($blood_groups_rds as $groups_rd) : ?>
                                                <option value="<?= $groups_rd['group_id'] ?>" <?= $groups_rd['group_id'] ==  $rd['blood_group_id'] ? 'selected' : '' ?>><?= $groups_rd['group_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="blood_process">Blood Process</label>
                                        <select class="form-control selectric" name="blood_process" id="blood_process">
                                            <option value="" disabled>Select</option>
                                            <?php foreach ($blood_processes_rds as $processes_rd) : ?>
                                                <option value="<?= $processes_rd['process_id'] ?>" <?= $processes_rd['process_id'] ==  $rd['blood_process_id'] ? 'selected' : '' ?>><?= ucwords($processes_rd['process_name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- blood processes && blood groups end -->

                                <!-- city && status start -->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="city">City</label>
                                        <select class="form-control selectric" name="city" id="city">
                                            <option value="" disabled>Select</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="status">Post Status</label>
                                        <select class="form-control selectric" name="status" id="status">
                                            <option value="" disabled>Select</option>
                                            <?php foreach ($statuses as $status) : ?>
                                                <?php if (strtolower($status['status_type']) == 'pending' or strtolower($status['status_type']) == 'rejected' or strtolower($status['status_type']) == 'approved') : ?>
                                                    <option value="<?= $status['status_id'] ?>" <?= $status['status_id'] ==  $rd['post_status'] ? 'selected' : '' ?>><?= ucwords($status['status_type']) ?></option>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <label for="post_type">Post Type</label>
                                        <select class="form-control selectric" name="post_type" id="post_type">
                                            <option value="" disabled>Select</option>

                                            <?php foreach ($post_types as $p_type) : ?>
                                                <option value="<?= $p_type; ?>" <?= $p_type ==  $rd['post_type'] ? 'selected' : '' ?>><?= ucwords($p_type); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- post type && status end -->

                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning" name="editBtn">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include('../layout.php');
?>