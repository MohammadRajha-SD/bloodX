<?php
    $pageTitle = "Donors";
    ob_start();
    session_start();
?>
<!-- TABLE FOR USERS -->
    <section class="section">
        <div class="section-header">
            <h1>Edit Donor</h1>
        </div>

        <div class="mb-3">
            <a href="<?= '../'; ?>" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Donors </h4>
                        </div>

                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <label for="email">Preview</label>
                                            <img src="" alt="">
                                        </div>
                                    </div>
                                    <!-- image && name start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="email">Image</label>
                                            <input type="file" class="form-control" id="pfp">
                                        </div>  
                                        <div class="form-floating mb-3">
                                            <label for="email">Name</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>  
                                    </div>
                                    <!-- image && name end -->

                                    <!-- email && username start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="email">Username</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>
                                    </div>
                                    <!-- email && username end -->


                                    <!-- phone && blood group start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="email">Phone</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="email">Blood Group</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>
                                    </div>
                                     <!-- phone && blood group end -->


                                     <!-- gender && bday start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="email">Gender</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="email">Birthday</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>
                                    </div>
                                     <!-- gender && bday end -->
                                    
                                    <!-- country && is_admin start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="email">Country</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>

                                        <div class="form-floating mb-3">
                                            <label for="email">Is Admin</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>
                                    </div>
                                    <!-- country && is_admin end -->

                                    <!-- acc_status && website_url start -->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="email">Account Status</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>    
                                    
                                        <div class="form-floating mb-3">
                                            <label for="email">Website URL</label>
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        </div>                                        
                                    </div>
                                    <!-- acc_status && website_url end -->
                                    
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-warning">Update</button>
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