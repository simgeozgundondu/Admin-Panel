<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">

    <span class="brand-text font-weight-light">GETLABS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="info">
        <a href="#" class="d-block">GET ADMIN</a>
      </div>
    </div>

    <?php
    $unread = $db->prepare("SELECT * FROM contact WHERE status=:status");
    $unread->execute(["status" => 0]);
    $number = $unread->rowCount();
    ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


        <li class="nav-item">
          <a href="blogs.php" class="nav-link ">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Blogs
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="newsletter.php" class="nav-link ">
            <i class='nav-icon fas fa-envelope-open-text'></i>
            <p>
              Mail Newsletter
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="mailbox.php" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Mail Box
            </p>
            <p class="badge badge-danger"><?= $number ?></p>
          </a>
        </li>

        <li class="nav-item">
          <a href="logout.php" class="nav-link">

            <p>
              Logout
            </p>

          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>