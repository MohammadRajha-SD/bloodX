<?php
include_once 'helpers/helpers.php';

define('LAYOUT_PATH', '/bt3/bloodX/admin/');
$_SESSION['LAYOUT_PATH'] = '/bt3/bloodX/admin/';
$_SESSION['DEFAULT_IMAGE_PATH'] = 'default.png';
$_SESSION['POST_TYPES'] = ['donation', 'request'];
$_SESSION['POST_STATUSES'] = ['pending', 'rejected', 'approved', 'inactive'];

if (!isset($_SESSION['USER']['username']) || !isset($_SESSION['USER']['is_admin']) || $_SESSION['USER']['is_admin'] == 0) {
  header('Location: ' . $_SESSION['LAYOUT_PATH_FRONTEND'] . 'auth/login.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $pageTitle ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= asset('assets/modules/bootstrap/css/bootstrap.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/fontawesome/css/all.min.css'); ?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= asset('assets/css/toastr.min.css'); ?>">

  <link rel="stylesheet" href="<?= asset('assets/modules/jqvmap/dist/jqvmap.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/summernote/summernote-bs4.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/select2/dist/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/jquery-selectric/selectric.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/modules/ionicons/css/ionicons.min.css'); ?>">

  <link rel="stylesheet" href="<?= asset('assets/modules/izitoast/css/iziToast.min.css'); ?>" />
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= asset('assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?= asset('assets/css/components.css'); ?>">

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
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
  <script src="<?= asset('assets/modules/jquery.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/popper.js'); ?>"></script>
  <script src="<?= asset('assets/modules/tooltip.js'); ?>"></script>
  <script src="<?= asset('assets/modules/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/nicescroll/jquery.nicescroll.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/moment.min.js'); ?>"></script>
  <script src="<?= asset('assets/js/stisla.js'); ?>"></script>

  <!-- JS Libraies -->
  <script src="<?= asset('assets/modules/jquery.sparkline.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/chart.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/summernote/summernote-bs4.js'); ?>"></script>
  <script src="<?= asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js'); ?>"></script>

  <!-- JS Libraies -->
  <script src="<?= asset('assets/modules/cleave-js/dist/cleave.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/cleave-js/dist/addons/cleave-phone.us.js'); ?>"></script>
  <script src="<?= asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
  <script src="<?= asset('assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/select2/dist/js/select2.full.min.js'); ?>"></script>
  <script src="<?= asset('assets/modules/jquery-selectric/jquery.selectric.min.js'); ?>"></script>

  <script src="<?= asset('assets/js/page/modules-toastr.js'); ?>"></script>

  <!-- JS Libraies -->
  <script src="<?= asset('assets/modules/izitoast/js/iziToast.min.js'); ?>"></script>
  <script src="<?= asset('assets/js/page/modules-ion-icons.js'); ?>"></script>

  <!-- Page Specific JS File -->
  <script src="<?= asset('assets/js/page/index.js'); ?>"></script>
  <!-- Template JS File -->
  <script src="<?= asset('assets/js/scripts.js'); ?>"></script>
  <script src="<?= asset('assets/js/toastr.min.js'); ?>"></script>
  <script src="<?= asset('assets/js/custom.js'); ?>"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
    $(document).ready(function() {
      $('body').on('click', '.delete-item', function(event) {
        event.preventDefault();

        let URL = $(this).attr('href');
        let id = $(this).data('id');
        let img = $(this).attr('data-image');
        let title = URL.startsWith('delete') ? 'Deleted' : 'Updated';

        swal({
          title: "Are you sure?",
          text: "This action cann't be undone",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          buttons: true,
          dangerMode: true
        }).then((will) => {
          if (will) {
            $.ajax({
              type: 'POST',
              url: URL,
              data: {
                id: id,
                img: img
              },
              success: function(data) {
                if (data.status === 'success') {
                  swal(data.message, {
                    title: title,
                    icon: "success",
                  }).then(() => {
                    window.location.reload();
                  });
                } else if (data.status === 'error') {
                  swal(data.message, {
                    title: "Can't delete it!",
                    icon: "error",
                  });
                }
              },
              error: function(xhr, status, error) {
                console.log(error);
              }
            });
          }
        });
      });
    });
  </script>
  <?php
  include 'flash.php';
  ?>
</body>

</html>