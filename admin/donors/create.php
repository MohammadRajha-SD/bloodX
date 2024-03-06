<?php
    $pageTitle = "Donors";
    ob_start();
    
    session_start();
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
                            <div class="card-header-action">
                                <a href="create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST">
                                <!-- Variant NAME START -->
                                    <div class="form-group">
                                        <label for="">Variant Name</label>
                                        <input type="text" class="form-control" name="variant_name" value="{{ $variant->name }}" readonly>
                                    </div>
                                <!-- Variant NAME END -->

                                <!-- Variant ID START -->
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="variant_id" value="{{ $variant->id }}">
                                    </div>
                                <!-- Variant ID END -->

                                <!-- PRODUCT ID START -->
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="product_id" value="{{ $product->id }}">
                                    </div>
                                <!-- PRODUCT ID END -->

                                <!-- ITEM NAME START -->
                                    <div class="form-group">
                                        <label for="">Item Name</label>
                                        <input type="text" class="form-control" name="item_name" value="">
                                    </div>
                                <!-- ITEM NAME END -->

                                <!-- PRICE START -->
                                    <div class="form-group">
                                        <label for="">Price <code>(Set 0 to make it free)</code></label>
                                        <input type="number" class="form-control" name="price">
                                    </div>
                                <!-- PRICE END -->

                                <!-- STATUS START -->
                                    <div class="form-group">
                                        <label for="is_default">Is Default</label>
                                        <select class="form-control selectric" id="is_default" name="is_default">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                <!-- STATUS END -->

                                <!-- STATUS START -->
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control selectric" id="status" name="status" value="{{ old('status') }}">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                <!-- STATUS END -->

                                <!-- SUBMIT BUTTON START -->
                                    <button class="btn btn-primary">+ Create</button>
                                <!-- SUBMIT BUTTON END -->
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