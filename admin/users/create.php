<?php
    include '../../config.php'; 
    include '../helpers/helpers.php';

    $pageTitle = "Users";
    ob_start();
    session_start();
    try{
        // Fetch blood groups table from database
        $query = <<<EOT
            SELECT * FROM blood_groups
        EOT;
        $stmt = $conn->prepare($query); 
        $stmt->execute(); 
        $blood_groups_rds= $stmt->fetchAll();

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

    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>
<!-- TABLE FOR USERS -->
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="../">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="../users/">Users</a></div>
              <div class="breadcrumb-item">Create User</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                             <h4>Create User</h4>
                             <div class="card-header-action">
                                <a href="<?= '../users'; ?>" class="btn btn-primary">Back</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="store.php" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- image && name start -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" />
                                        </div>  
                                        
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name..." value="<?= old('name')?>" required>
                                        </div>  
                                        <div class="form-floating mb-3">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= old('email')?>"  required>
                                        </div>
                                    </div>
                                    <!-- image && name end -->

                                    <!-- email && username start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="<?= old('username')?>"  required>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="passwrd">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="passwrd" placeholder="Password..."  value="<?= old('passwrd')?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-eye" id="togglePassword"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- email && username end -->

                                    <!-- phone && blood group start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number..." value="<?= old('phone')?>"  required>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="blood_group">Blood Group</label>
                                            <select class="form-control selectric" name="blood_group" id="blood_group" required>
                                                <option value="">Select</option>
                                                <?php foreach($blood_groups_rds as $groups_rd): ?>
                                                    <option value="<?= $groups_rd['group_id'] ?>" <?= $groups_rd['group_id'] == old('blood_group') ? 'selected': '' ?>><?= $groups_rd['group_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                     <!-- phone && blood group end -->

                                     <!-- gender && birthday start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="gender">Gender</label>
                                            <select class="form-control selectric" name="gender" id="gender"  required>
                                                <option value="">Select</option>
                                                <option value="male"  <?= old('gender') == "male" ? 'selected' : ''; ?>>Male</option>
                                                <option value="female" <?= old('gender') == "female" ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="birthday">Birthday</label>
                                            <input type="text" class="form-control datepicker"  id="birthday" name="birthday" placeholder="Birthday..." value="<?= old('birthday')?>"  required>
                                        </div>
                                    </div>
                                     <!-- gender && birthday end -->
                                    
                                    <!-- country && is_admin start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="country">Country</label>
                                            <select class="form-control selectric" name="country" id="country" required>
                                                <option value="">Select</option>
                                                <?php foreach($countries as $country): ?>
                                                    <option value="<?= $country['country_id'] ?>" <?= $country['country_id'] == old('country') ? 'selected': '' ?>><?= $country['country_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="is_admin">Role</label>
                                            <select class="form-control selectric" name="is_admin" id="is_admin"   required>
                                                <option value="">Select</option>
                                                <option value="1" <?= old('is_admin') == 1 ? 'selected' : ''; ?>>Admin</option>
                                                <option value="0" <?= old('is_admin') == 0 ? 'selected' : ''; ?>>User</option>
                                            </select>
                                        </div>
                                       
                                    </div>
                                    <!-- country && is_admin end -->

                                    <!-- acc_status && website_url start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="website_url">Website URL</label>
                                            <input type="url" class="form-control" id="website_url" name="website_url" placeholder="https://www.google.com" value="<?= old('website_url')?>" >
                                        </div>                                        
                                        <div class="form-floating mb-3">
                                            <label for="acc_status">Account Status</label>
                                            <select class="form-control selectric" name="acc_status" id="acc_status" value="<?= old('acc_status')?>"  required>
                                                <option value="">Select</option>
                                                <?php foreach($statusesdb as $status): ?>
                                                    <?php if(strtolower($status['status_type']) == 'active' or strtolower($status['status_type']) == 'suspended'): ?>
                                                        <option value="<?= $status['status_id'] ?>"<?=  $status['status_id'] == old('acc_status') ? 'selected' : ''?> ><?= ucwords($status['status_type']) ?></option>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>  
                                    </div>
                                    <!-- acc_status && website_url end -->
                                    
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-warning" name="createBtn">Create</button>
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
<script>
    // Show/hide password functionality
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>

<?php   
    $content = ob_get_clean(); 
    include('../layout.php');
?>