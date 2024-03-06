<?php
    $pageTitle = "Supplicants";
    ob_start();
    
    session_start();
?>
<!-- TABLE FOR Supplicants -->
    <section class="section">
        <div class="section-header">
            <h1>Supplicants Details</h1>
        </div>

        <div class="mb-3">
            <a href="<?= '../'; ?>" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Supplicants </h4>
                            <div class="card-header-action">
                                <a href="create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>                                 
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Task Name</th>
                                            <th>Progress</th>
                                            <th>Members</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>                                 
                                        <tr>
                                            <td>
                                                2
                                            </td>
                                            <td>Redesign homepage</td>
                                            <td class="align-middle">
                                                <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                                <div class="progress-bar" data-width="0"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <img alt="image" src="<?= $_SESSION['LAYOUT_PATH'].'assets/img/avatar/avatar-1.png' ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                                                <img alt="image" src="<?= $_SESSION['LAYOUT_PATH'].'assets/img/avatar/avatar-3.png' ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                                                <img alt="image" src="<?= $_SESSION['LAYOUT_PATH'].'assets/img/avatar/avatar-4.png' ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                                            </td>
                                            <td>2018-04-10</td>
                                            <td><div class="badge badge-info">Todo</div></td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
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
<!-- // TABLE FOR Supplicants // -->

<?php   
    $content = ob_get_clean(); 
    include('../layout.php');
?>