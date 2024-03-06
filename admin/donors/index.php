<?php
    include '../config.php';
    $pageTitle = "Donors";

    ob_start();
    session_start();

    $post_type = "donation";
    $donors_query = "SELECT users.*, posts.*, blood_groups.* FROM users INNER JOIN posts ON users.user_id = posts.user_id INNER JOIN blood_groups ON posts.blood_group_id = blood_groups.group_id WHERE posts.post_type = ?";
    
    function setAdmin($admin){
        if ($admin){
            return '<div class="badge badge-primary"><i class="fas fa-check"></i></div>';
        }else{
            return '<div class="badge badge-danger"><i class="fas fa-times"></i></div>';
        }
    }
?>
<!-- TABLE FOR USERS -->
    <section class="section">
        <div class="section-header">
            <h1>Donors Details</h1>
        </div>

        <div class="mb-3">
            <a href="<?= '../'; ?>" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Donors </h4>
                            <!-- <div class="card-header-action">
                                <a href="create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                            </div> -->
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            try{
                                                $stmt = $conn->prepare($donors_query); 
                                                $stmt->execute([$post_type]); 
                                                $result = $stmt->fetchAll();

                                                foreach ($result as $row) {
                                                    $ad_query = "SELECT TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age,  DATE_FORMAT(donated_at, '%b %m-%y')AS donated FROM users WHERE user_id = ?";
 
                                                    $stmt = $conn->prepare($ad_query); 
                                                    $stmt->execute([$row['user_id']]); 
                                                    $result = $stmt->fetch();

                                                    $age = $result['age'];
                                                    $donated = $result['donated'];

                                                    echo '<tr>';
                                                        echo '<td>'. $row["user_id"]. '</td>';
                                                        echo '<td>'. $row["username"].'</td>';
                                                        echo '<td>'. $row["group_name"].'</td>';
                                                        echo '<td>'. $row["country"]. '</td>';
                                                        echo '<td>'. $row["gender"]. '</td>';
                                                        echo '<td>'. $age. '</td>';
                                                        echo '<td><div class="badge badge-danger">Suspended</div></td>';
                                                        echo '<td>' . setAdmin($row["is_admin"]). '</td>';
                                                        echo '<td>' . $donated . '</td>';


                                                        echo '<td>
                                                            <div class="btn-group dropleft">
                                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-cog"></i>
                                                                </button>

                                                                <div class="dropdown-menu dropleft">
                                                                    <a class="dropdown-item" href="#">Actions</a>
                                                                    <div class="dropdown-divider"></div> 
                                                                    <a class="dropdown-item" class="text-primary" href="#">view</a>
                                                                    <a class="dropdown-item" class="text-primary" href="edit.php">edit</a>
                                                                    <a class="dropdown-item" class="text-primary" href="#">delete</a>
                                                                </div>
                                                            </div>
                                                        </td>';

                                                    echo "</tr>";
                                            }
                                            }catch(PDOException $e){
                                                echo $e->getMessage();
                                            } 
                                        ?>
                                        </tbody>
                                    </table>
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
