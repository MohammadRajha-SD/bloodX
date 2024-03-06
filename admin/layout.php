<?php
  include 'config.php';
  include_once 'helpers/helpers.php';
  
  define('LAYOUT_PATH', '/bt3/bloodX/admin/');
  $_SESSION['LAYOUT_PATH'] = '/bt3/bloodX/admin/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blood X</title>
  

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo asset('assets/modules/bootstrap/css/bootstrap.css');?>">
  <link rel="stylesheet" href="<?php echo asset('assets/modules/fontawesome/css/all.min.css');?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo asset('assets/modules/jqvmap/dist/jqvmap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('assets/modules/summernote/summernote-bs4.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css'); ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo asset('assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('assets/css/components.css'); ?>">

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>

  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
     
      <!-- NAVBAR -->
        <?php include_once('navbar.php'); ?>
      <!-- // NAVBAR // -->

      <!-- SIDEBAR -->
        <?php include_once('sidebar.php'); ?>
      <!-- // SIDEBAR // -->

      <!-- Main Content -->
        <main class="my-3 main-content">
          <?= $content; ?> 
        </main>  
      <!-- // Main Content // -->

      <footer class="main-footer">
        <?php include_once('footer.php'); ?>
      </footer>
    </div>
  </div>
  
  <!-- General JS Scripts -->
  <script src="<?php echo asset('assets/modules/jquery.min.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/popper.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/tooltip.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/nicescroll/jquery.nicescroll.min.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/moment.min.js'); ?>"></script>
  <script src="<?php echo asset('assets/js/stisla.js'); ?>"></script>
  
  <!-- JS Libraies -->
  <script src="<?php echo asset('assets/modules/jquery.sparkline.min.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/chart.min.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/summernote/summernote-bs4.js'); ?>"></script>
  <script src="<?php echo asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js'); ?>"></script>

  <!-- Page Specific JS File -->
  <script src="<?php echo asset('assets/js/page/index.js'); ?>"></script>

  <!-- Template JS File -->
  <script src="<?php echo asset('assets/js/scripts.js'); ?>"></script>
  <script src="<?php echo asset('assets/js/custom.js'); ?>"></script>
</body>
</html>