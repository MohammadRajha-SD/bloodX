<?php
include_once 'helpers/helpers.php';

define('LAYOUT_PATH_FRONTEND', '/bt3/bloodX/');
$_SESSION['LAYOUT_PATH_FRONTEND'] = '/bt3/bloodX/';
$_SESSION['ADMIN_ARRAY'] = ['admin', 'admin@gmail.com'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <title><?= $pageTitle; ?></title>
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link rel="stylesheet" href="<?= asset('assets/css/all.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/slick.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/jquery.nice-number.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/jquery.calendar.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/add_row_custon.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/mobile_menu.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/jquery.exzoom.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/multiple-image-video.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/ranger_style.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/jquery.classycountdown.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/venobox.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/virtual-select.min.css'); ?>" />
  <link rel="stylesheet" href="<?= asset('assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/responsive.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/jquery-selectric/selectric.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/toastr.min.css'); ?>">

  <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>

  <!--============================
        HEADER START
    ==============================-->
  <?php include_once('header.php'); ?>
  <!--============================
        HEADER END
    ==============================-->

  <!--============================
        MAIN MENU START
    ==============================-->
  <?php include_once('navbar.php'); ?>
  <!--============================
        MAIN MENU END
    ==============================-->


  <!-- Main Content -->
  <main class="my-3 main-content">
    <?= $content; ?>
  </main>
  <!-- // Main Content // -->

  <!--============================
        FOOTER PART START
    ==============================-->
  <?php include_once('footer.php'); ?>

  <!--============================
        FOOTER PART END
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!--jquery library js-->
  <script src="<?= asset('assets/js/jquery-3.6.0.min.js'); ?>"></script>
  <!--bootstrap js-->
  <script src="<?= asset('assets/js/bootstrap.bundle.min.js'); ?>"></script>
  <!--font-awesome js-->
  <script src="<?= asset('assets/js/Font-Awesome.js'); ?>"></script>
  <!--select2 js-->
  <script src="<?= asset('assets/js/select2.min.js'); ?>"></script>
  <!--slick slider js-->
  <script src="<?= asset('assets/js/slick.min.js'); ?>"></script>
  <!--simplyCountdown js-->
  <script src="<?= asset('assets/js/simplyCountdown.js'); ?>"></script>
  <!--product zoomer js-->
  <script src="<?= asset('assets/js/jquery.exzoom.js'); ?>"></script>
  <!--nice-number js-->
  <script src="<?= asset('assets/js/jquery.nice-number.min.js'); ?>"></script>
  <!--counter js-->
  <script src="<?= asset('assets/js/jquery.waypoints.min.js'); ?>"></script>
  <script src="<?= asset('assets/js/jquery.countup.min.js'); ?>"></script>
  <!--add row js-->
  <script src="<?= asset('assets/js/add_row_custon.js'); ?>"></script>
  <!--multiple-image-video js-->
  <script src="<?= asset('assets/js/multiple-image-video.js'); ?>"></script>
  <!--sticky sidebar js-->
  <script src="<?= asset('assets/js/sticky_sidebar.js'); ?>"></script>
  <!--price ranger js-->
  <script src="<?= asset('assets/js/ranger_jquery-ui.min.js'); ?>"></script>
  <script src="<?= asset('assets/js/ranger_slider.js'); ?>"></script>
  <!--isotope js-->
  <script src="<?= asset('assets/js/isotope.pkgd.min.js'); ?>"></script>
  <!--venobox js-->
  <script src="<?= asset('assets/js/venobox.min.js'); ?>"></script>
  <!--classycountdown js-->
  <script src="<?= asset('assets/js/jquery.classycountdown.js'); ?>"></script>

  <!--main/custom js-->
  <script src="<?= asset('assets/js/main.js'); ?>"></script>
  <script src="<?= asset('assets/js/virtual-select.min.js'); ?>"></script>
  <script src="<?= asset('assets/js/toastr.min.js'); ?>"></script>

  <script>
    VirtualSelect.init({
      ele: '#BloodGroupSelect',
      popupDropboxBreakpoint: '3000px',
    });
    VirtualSelect.init({
      ele: '#CountrySelect',
      popupDropboxBreakpoint: '3000px'
    });
    VirtualSelect.init({
      ele: '#GenderSelect'
    });
    VirtualSelect.init({
      ele: '#diseases',
      popupDropboxBreakpoint: '3000px'
    });
  </script>
  <?php
  include 'flash.php';
  ?>
</body>

</html>