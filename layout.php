<?php
  function asset($path) {
      $dir = '/bt3/project1/';
      if(!isset($path)){
        return $dir;
      }
      return $dir . $path;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageTitle ?? 'Blood X'; ?> </title>
  
    <!-- CSS IMPORT -->
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap.css'); ?>" />
    
    <!-- Others -->
    <link rel="stylesheet" href="<?php echo asset('css/virtual-select.min.css');?>" />
    <link rel="stylesheet" href="<?php echo asset('fonts/css/font-awesome.css'); ?>">
  
  </head>
  <body>
    <?php 
      include('header.php'); 
    ?>

    <main class="my-3">
        <?php echo $content; ?>
    </main>

    <?php 
      include('footer.php'); 
    ?> 

    <script type="text/javascript" src="<?php echo  asset('js/script.js'); ?>"></script>
    <script src="<?php echo asset('js/virtual-select.min.js'); ?>"></script>
    <script src="<?php echo asset('js/bootstrap.min.js'); ?>"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

    <!-- TO MAKE DESGIN FOR SELECT TAG  -->
      <script>
        // VirtualSelect.init({
        //   ele: '#nationalitiesSelect'
        // });
      </script>
    <!-- // TO MAKE DESGIN FOR SELECT TAG //  -->

    <!-- FLASH MSG IS GOING HERE -->
      <div class="position-absolute" style="bottom: 2%; right: 2%;">
        <?php // include('flash.php'); ?>
      </div>
    <!-- // FLASH MSG IS GOING HERE // -->

  </body>
</html>