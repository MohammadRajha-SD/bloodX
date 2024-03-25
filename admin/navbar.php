 <div class="navbar-bg">
   <nav class="navbar navbar-expand-lg main-navbar">
     <form class="form-inline mr-auto">
       <ul class="navbar-nav mr-3">
         <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
         <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
       </ul>

       <div class="search-element">
         <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
         <button class="btn" type="submit"><i class="fas fa-search"></i></button>
         <div class="search-backdrop"></div>
         <div class="search-result">
         </div>
       </div>

     </form>

     <ul class="navbar-nav navbar-right">
       <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg"></a>
         <div class="dropdown-menu dropdown-list dropdown-menu-right">
           <div class="dropdown-item-avatar">
             <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
             <div class="is-online"></div>
           </div>
       </li>
       <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
           <img alt="image" src="<?= asset('assets/uploads/' . $_SESSION['USER']['profile_pic']) ?>" class="rounded-circle mr-1 ">
           <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['USER']['username']; ?></div>
         </a>
         <div class="dropdown-menu dropdown-menu-right">
           <a href="<?= asset('profile/index.php') ?>" class="dropdown-item has-icon">
             <i class="far fa-user"></i> Profile
           </a>
           <a href="features-settings.html" class="dropdown-item has-icon">
             <i class="fas fa-cog"></i> Settings
           </a>
           <div class="dropdown-divider"></div>
           <a href="<?= $_SESSION['LAYOUT_PATH_FRONTEND'] . 'auth/logout.php'; ?>" class="dropdown-item has-icon text-danger">
             <i class="fas fa-sign-out-alt"></i> Logout
           </a>
         </div>
       </li>
     </ul>
   </nav>