<?php
include '../../config.php';
include '../helpers/helpers.php';

$pageTitle = "Users";
ob_start();
session_start();

if (isset($_GET['id']) && $_GET['id'] != '') {
    try {
        // Fetch users table from database
        $user_id = $_GET['id'];

        $query = 'SELECT users.*, user_diseases.* FROM users 
        INNER JOIN  user_diseases ON users.user_id = user_diseases.user_id
        WHERE users.user_id = ?';
        $stmt = $conn->prepare($query);
        $stmt->execute([$user_id]);
        $rd = $stmt->fetch();

        // Fetch blood groups table from database
        $query = <<<EOT
                SELECT * FROM blood_groups
            EOT;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $blood_groups_rds = $stmt->fetchAll();

        // Fetch countries table from database
        $query = <<<EOT
                SELECT * FROM countries
            EOT;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $countries = $stmt->fetchAll();

        // Fetch statuses table from database
        $query = <<<EOT
                SELECT * FROM statuses
            EOT;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $statusesdb = $stmt->fetchAll();

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
<!-- TABLE FOR USERS -->
<section class="section">
    <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="../">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="../users/">Users</a></div>
            <div class="breadcrumb-item">Edit User</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit User : <?= ucwords($rd['username']) ?> </h4>
                        <div class="card-header-action">
                            <a href="<?= '../users'; ?>" class="btn btn-primary">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="update.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <label for="preview">Preview</label><br>
                                        <img src="<?= asset('assets/uploads/' . $rd['profile_pic']); ?>" alt="" id="preview" width="200" height="200" class="rounded border  shadow-sm" style="object-fit: contain;   pointer-events: none;">
                                        <input type="hidden" name="user_id" value="<?= $rd['user_id'] ?>">
                                        <input type="hidden" name="old_path_image" value="<?= $rd['profile_pic'] ?>">
                                    </div>
                                </div>
                                <!-- image && name start -->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image" />
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name..." value="<?= $rd['name'] ?>">
                                    </div>
                                </div>
                                <!-- image && name end -->

                                <!-- email && username start -->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= $rd['email'] ?>">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="<?= $rd['username'] ?>">
                                    </div>
                                </div>
                                <!-- email && username end -->

                                <!-- phone && blood group start -->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number..." value="<?= $rd['phone_number'] ?>">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="blood_group">Blood Group</label>
                                        <select class="form-control selectric" name="blood_group" id="blood_group">
                                            <option value="" disabled>Select</option>
                                            <?php foreach ($blood_groups_rds as $groups_rd) : ?>
                                                <option value="<?= $groups_rd['group_id'] ?>" <?= $groups_rd['group_id'] ==  $rd['blood_group_id'] ? 'selected' : '' ?>><?= $groups_rd['group_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- phone && blood group end -->

                                <!-- gender && birthday start -->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="gender">Gender</label>
                                        <select class="form-control selectric" name="gender" id="gender">
                                            <option value="" disabled>Select</option>
                                            <option value="male" <?= $rd['gender'] ==  'male'   ? 'selected' : '' ?>>Male</option>
                                            <option value="femal" <?= $rd['gender'] ==  'female' ? 'selected' : '' ?>>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="birthday">Birthday</label>
                                        <input type="text" class="form-control datepicker" id="birthday" name="birthday" placeholder="Birthday...">
                                    </div>
                                </div>
                                <!-- gender && birthday end -->

                                <!-- country && is_admin start -->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="country">Country</label>
                                        <select class="form-control selectric" name="country" id="country">
                                            <option value="" disabled>Select</option>
                                            <?php foreach ($countries as $country) : ?>
                                                <option value="<?= $country['country_id'] ?>" <?= $country['country_id'] ==  $rd['country_id'] ? 'selected' : '' ?>><?= $country['country_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="is_admin">Role</label>
                                        <select class="form-control selectric" name="is_admin" id="is_admin">
                                            <option value="" disabled>Select</option>
                                            <option value="1" <?= $rd['is_admin'] == 1 ? 'selected' : '' ?>>Admin</option>
                                            <option value="0" <?= $rd['is_admin'] == 0 ? 'selected' : '' ?>>User</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- country && is_admin end -->

                                <!-- acc_status && website_url start -->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <label for="website_url">Website URL</label>
                                        <input type="url" class="form-control" id="website_url" name="website_url" placeholder="https://www.google.com" value="<?= $rd['website_url'] ?? '' ?>">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="acc_status">Account Status</label>
                                        <select class="form-control selectric" name="acc_status" id="acc_status">
                                            <option value="" disabled>Select</option>
                                            <?php foreach ($statusesdb as $status) : ?>
                                                <?php if (strtolower($status['status_type']) == 'active' or strtolower($status['status_type']) == 'suspended') : ?>
                                                    <option value="<?= $status['status_id'] ?>" <?= $status['status_id'] ==  $rd['acc_status'] ? 'selected' : '' ?>><?= ucwords($status['status_type']) ?></option>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- acc_status && website_url end -->
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <label for="disease_id">Diseases</label>
                                        <select class="form-control selectric" name="disease_id" id="disease_id">
                                            <?php foreach ($diseases as $disease) : ?>
                                                <option value="<?= $disease['disease_id'] ?>" <?= $disease['disease_id'] ==  $rd['disease_id'] ? 'selected' : '' ?>><?= ucwords($disease['disease_name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
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
<!-- // TABLE FOR DONORS // -->

<?php
$content = ob_get_clean();
include('../layout.php');
?>