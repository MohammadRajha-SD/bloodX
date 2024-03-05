<?php
  $pageTitle = "Home";
  ob_start();
  session_start();
  
?>

<div class="container">
   Home Page is going here!.
   <div>
    <button class="btn btn-primary">CHECK ME HERE</button>
   </div>
</div>

<?php
  $content = ob_get_clean(); 
  include('layout.php'); 
?>