<?php
    include '../config.php';
    $pageTitle = "Donors";
    ob_start();

    session_start();

    $query = "SELECT * FROM users ORDER BY user_id"; 
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

                                            $stmt = $conn->prepare($query); 
                                            $stmt->execute(); 
                                            $result = $stmt->fetchAll();

                                            foreach ($result as $row) { 
                                                echo "<tr>";
                                                echo "<td>" . $row["user_id"]. "></td>";
                                                echo "<td>" . $row["username"]. "></td>";
                                                echo "<td>" . $row["email"]. "></td>";
                                                echo "</tr>";
                                            }
                                        }catch(PDOException $e){
                                            echo $e->getMessage();
                                        }
                                        
                                        ?>

                                        <tr>
                                            <td>1</td>
                                            <td>Mohammad</td>
                                            <td>O+-</td>
                                            <td>IDLIBY</td>
                                            <td>GoodMAN</td>
                                            <td>20</td>
                                            <td><div class="badge badge-danger">Suspended</div></td>
                                            <td><div class="badge badge-primary">Yes</div></td>
                                            <td>201</td>
                                            <td>
                                                <div class="btn-group dropleft">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-menu"></i>
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropleft">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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