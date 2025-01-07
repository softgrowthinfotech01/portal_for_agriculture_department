<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
    </ul>

    <!-- Right navbar links -->
 
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
       <a>  Hello,</a>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row_user_details[0]['user_name'];?></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="all_blogs" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Blog List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="add_blog" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Add Blog
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="change_password" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout" class="nav-link">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="support" class="nav-link">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>
              Help
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>