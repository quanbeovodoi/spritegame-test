<?php

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../contacts.php" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
   
  </nav>
  <aside class="main-sidebar sidebar-blue elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="admin_images/<?php echo $admin_image; ?>" alt="<?php echo $admin_image; ?>" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $admin_name; ?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php?dashboard" class="nav-link <?php if(isset($_GET['dashboard'])){echo"active";};?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if(isset($_GET['view_products'])||isset($_GET['insert_products'])||isset($_GET['edit_product'])){echo"active";};?>">
              <i class="nav-icon fa fa-archive"></i>
              <p>
                Sản Phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?insert_products" class="nav-link">
                  <p>Thêm Sản Phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view_products" class="nav-link">
                  <p>xem Sản Phẩm</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if(isset($_GET['view_cats'])||isset($_GET['insert_cat'])||isset($_GET['edit_cat'])){echo"active";};?>">
            <i class="nav-icon fas fa-book-open"></i>
              <p>
                Thể Loại
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?insert_cat" class="nav-link">
                  <p>Thêm Thể Loại</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view_cats" class="nav-link">
                  <p>xem Thể Loại</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if(isset($_GET['view_p_categories'])||isset($_GET['insert_p_category'])||isset($_GET['edit_p_cat'])){echo"active";};?>">
            <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Danh Mục Sản Phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?insert_p_category" class="nav-link">
                  <p>Thêm Danh Mục Sản Phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view_p_categories" class="nav-link">
                  <p>xem Danh Mục Sản Phẩm</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if(isset($_GET['insert_slide'])||isset($_GET['view_slides'])||isset($_GET['edit_slide'])){echo"active";};?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Slide
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?insert_slide" class="nav-link">
                  <p>Thêm Slide</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view_slides" class="nav-link">
                  <p>xem Slide</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if(isset($_GET['insert_coupon'])||isset($_GET['view_coupons'])||isset($_GET['edit_coupon'])){echo"active";};?>">
            <i class="nav-icon fas fa-tags"></i>
              <p>
                Phiếu giảm giá
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?insert_coupon" class="nav-link">
                  <p>Thêm phiếu giảm giá</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view_coupons" class="nav-link">
                  <p>xem phiếu giảm giá</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?view_customers" class="nav-link <?php if(isset($_GET['view_customers'])){echo"active";};?>">
            <i class="nav-icon fas fa-users"></i>
              <p>
                Xem khách hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?view_orders" class="nav-link <?php if(isset($_GET['view_orders'])){echo"active";};?>">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Xem đơn đạt hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if(isset($_GET['view_users'])||isset($_GET['user_profile'])||isset($_GET['insert_user'])){echo"active";};?>">
            <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Administrator
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?insert_user" class="nav-link">
                  <p>Thêm admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?user_profile=<?php echo $admin_id; ?>" class="nav-link">
                  <p>Sửa admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view_users" class="nav-link">
                  <p>xem admin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Đăng xuất
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php } ?>