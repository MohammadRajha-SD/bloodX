<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="<?= LAYOUT_PATH ?>">B l o o d X</a>
      </div>

      <div class="sidebar-brand sidebar-brand-sm">
        <a href="<?= LAYOUT_PATH ?>">BX</a>
      </div>

      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown <?=  setActive(['/bt3/bloodX/admin/index.php']); ?> ">
          <a href="<?= LAYOUT_PATH.'index.php'; ?>" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
        </li>

        <li class="dropdown <?= setActive([
          '/bt3/bloodX/admin/donors/', 
          '/bt3/bloodX/admin/donors/index.php',
          '/bt3/bloodX/admin/donors/edit.php',
          '/bt3/bloodX/admin/supplicants/', 
          '/bt3/bloodX/admin/supplicants/index.php',
          '/bt3/bloodX/admin/supplicants/edit.php',
        ]); ?>">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Manage Users</span></a>
          <ul class="dropdown-menu ">
            <li ><a class="nav-link" href="<?= LAYOUT_PATH.'users/index.php'; ?>">Users</a></li>
            <li ><a class="nav-link" href="<?= LAYOUT_PATH.'donors/index.php'; ?>">Donors</a></li>
            <li ><a class="nav-link" href="<?= LAYOUT_PATH.'supplicants/index.php'; ?>">Supplicants</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-heart"></i><span>Manage Posts</span></a>
          <ul class="dropdown-menu">
            <li ><a class="nav-link" href="#">Donations</a></li>
            <li ><a class="nav-link" href="#">Requests</a></li>
          </ul>
        </li>
      </ul>
  </aside>
</div>