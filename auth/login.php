<?php
include '../helpers/helpers.php';
include '../config.php';

if (isset($_SESSION['USER']['username']) && $_SESSION['USER']['username'] != '') {
    header('Location: ../index.php');
    exit();
}

$pageTitle = "Login";
ob_start();
try {
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
    $query = <<<EOT
        SELECT * FROM diseases
    EOT;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $diseases = $stmt->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<style>
    /* Custom CSS for password field */
    .password-toggle {
        position: relative;
    }

    .password-toggle .toggle-password {
        position: absolute;
        top: 0;
        right: 0;
        cursor: pointer;
        padding: 20px 10px;
        border-left: 1px solid;
    }
</style>

<!--============================
         BREADCRUMB START
    ==============================-->
<section id="wsus__breadcrumb">
    <div class="wsus_breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>Login / Register</h4>
                    <ul>
                        <li><a href="#">home</a></li>
                        <li><a href="#">Login / Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        BREADCRUMB END
    ==============================-->

<!--============================
       LOGIN/REGISTER PAGE START
    ==============================-->
<section id="wsus__login_register">
    <div class="container">
        <div class="row">
            <div class="col-7 m-auto">
                <div class="wsus__login_reg_area">
                    <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill" data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes" aria-selected="true">login</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill" data-bs-target="#pills-profiles" type="button" role="tab" aria-controls="pills-profiles" aria-selected="true">signup</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent2">
                        <!-- Login START -->
                        <div class="tab-pane fade  show active" id="pills-homes" role="tabpanel" aria-labelledby="pills-home-tab2">
                            <div class="wsus__login">
                                <form method="POST" action="signin.php">
                                    <div class=" wsus__login_input">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="text" class="form-control" placeholder="username, or email" name="usernameOrEmail" required>
                                    </div>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="wsus__login_save">
                                        <!-- <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Remember me</label>
                                        </div> -->
                                        <!-- <a class="forget_p" href="forget_password.html">forgot password?</a> -->
                                    </div>
                                    <button class="common_btn" type="submit">login</button>
                                </form>
                            </div>
                        </div>
                        <!-- Login END -->

                        <!-- Register START -->
                        <div class="tab-pane fade " id="pills-profiles" role="tabpanel" aria-labelledby="pills-profile-tab2">
                            <form method="POST" action="signup.php">
                                <div class="row">
                                    <!-- image && name start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name..." value="<?= old('name') ?>" required>
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= old('email') ?>" required>
                                            <label for="email">Email address</label>
                                        </div>
                                    </div>
                                    <!-- image && name end -->

                                    <!-- email && username start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="<?= old('username') ?>" required>
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3 password-toggle">
                                            <input type="password" class="form-control" id="password" name="passwrd" placeholder="Password" required>
                                            <label for="password">Password</label>
                                            <span><i class="fas fa-eye toggle-password" id="toggle-password"></i></span>
                                        </div>
                                    </div>
                                    <!-- email && username end -->

                                    <!-- phone && blood group start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number..." value="<?= old('phone') ?>" required>
                                            <label for="phone">Phone</label>
                                        </div>
                                        <select class="mw-100 " name="blood_group_id" id="BloodGroupSelect" placeholder="Blood Group" data-search="true" data-silent-initial-value-set="true">
                                            <option value="" disabled selected>Blood Group</option>
                                            <?php foreach ($blood_groups_rds as $groups_rd) : ?>
                                                <option value="<?= $groups_rd['group_id'] ?>" <?= $groups_rd['group_id'] == old('blood_group_id') ? 'selected' : '' ?>><?= $groups_rd['group_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- phone && blood group end -->

                                    <!-- gender && birthday start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Date Of Birth" required />
                                            <label for="birthday">Birthday</label>
                                        </div>
                                        <select class="mw-100 mb-3" id="GenderSelect" placeholder="Gender" data-search="true" data-silent-initial-value-set="true" name="gender">
                                            <option value="" disabled selected>Gender</option>
                                            <option value="male" <?= old('gender') == "male" ? 'selected' : ''; ?>>Male</option>
                                            <option value="female" <?= old('gender') == "female" ? 'selected' : ''; ?>>Female</option>
                                        </select>
                                    </div>
                                    <!-- gender && birthday end -->

                                    <!-- country && is_admin start -->
                                    <div class="col-6">
                                        <select class="mw-100 mb-3" id="CountrySelect" placeholder="Country" data-search="true" data-silent-initial-value-set="false" name="country">
                                            <option value="" disabled selected>Country</option>
                                            <?php foreach ($countries as $country) : ?>
                                                <option value="<?= $country['country_id'] ?>" <?= $country['country_id'] == old('country') ? 'selected' : '' ?>><?= $country['country_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- country && is_admin end -->

                                    <div class="col-6">
                                        <select class="mw-100 mb-3" id="diseases" class="DiseasesSelect" placeholder="No Diseases" data-search="true" data-silent-initial-value-set="true" name="diseases[]" multiple>
                                            <option value="" disabled selected>No Diseases</option>
                                            <?php foreach ($diseases as $d) : ?>
                                                <option value="<?= $d['disease_id'] ?>" <?= (old('diseases') ? in_array($d['disease_id'], old('diseases')) : false) ? 'selected' : '' ?>> <?= $d['disease_name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary w-50" name="createBtn">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Register END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Show/hide password functionality
    const togglePassword = document.getElementById('toggle-password');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
<!--============================
       LOGIN/REGISTER PAGE END
    ==============================-->


<!--============================
        SCROLL BUTTON START
    ==============================-->
<div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
</div>
<!--============================
        SCROLL BUTTON  END
    ==============================-->
<?php
$content = ob_get_clean();
include('../layout.php');
?>