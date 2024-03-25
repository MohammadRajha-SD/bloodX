<?php
include 'helpers/helpers.php';
$pageTitle = "Home";
ob_start();

?>
<!--============================
        HOT DEALS START
    ==============================-->
<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">
        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">
                            <button class="ms-0 active" data-filter="*">All</button>
                            <button data-filter=".clotha">Donations</button>
                            <button data-filter=".cama">Requests</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row grid2">
                <div class="col-xl-3 col-sm-6 col-md-4 col-lg-4 eleca cama">
                    <div class="wsus__product_item">
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="<?= asset('assets/images/headphone_1.jpg'); ?>" alt="product" class="img-fluid w-100 img_1" />
                            <img src="<?= asset('assets/images/headphone_2.jpg'); ?>" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <!-- <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul> -->
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">Electronics </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(120 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">man casual fashion cap</a>
                            <p class="wsus__price">$115</p>
                            <a class="add_cart" href="#">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        HOT DEALS END  
    ==============================-->



<?php
$content = ob_get_clean();
include('layout.php');
?>