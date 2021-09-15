<?php

    session_start();

    include("../includes/db.php");

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
        $admin_session = $_SESSION['admin_email'];

        $get_admin = "select * from admins where admin_email='$admin_session'";
        
        $run_admin = mysqli_query($conn,$get_admin);

        $row_admin = mysqli_fetch_array($run_admin);

            $admin_id = $row_admin['admin_id'];

            $admin_name = $row_admin['admin_name'];

            $admin_email = $row_admin['admin_email'];

            $admin_image = $row_admin['admin_image'];


        $get_products = "select * from products";

        $run_products = mysqli_query($conn,$get_products);

        $count_products = mysqli_num_rows($run_products);


        $get_customers = "select * from customers";

        $run_customers = mysqli_query($conn, $get_customers);

        $count_customers = mysqli_num_rows($run_customers);


        $get_product_category = "select * from product_categories";

        $run_product_category = mysqli_query($conn, $get_product_category);

        $count_product_category = mysqli_num_rows($run_product_category);
        

        $get_customer_orders = "select * from customer_orders";

        $run_customer_orders = mysqli_query($conn, $get_customer_orders);

        $count_customer_orders = mysqli_num_rows($run_customer_orders);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 
  <?php include("includes/sidebar.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1301.28px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <?php 

                //dashboard

                if(isset($_GET['dashboard'])){

                    include("dashboard.php");

                }
                
                //products

                if(isset($_GET['insert_products'])){

                    include("insert_product.php");

                }
                
                if(isset($_GET['view_products'])){

                    include("view_products.php");

                }
                
                if(isset($_GET['delete_product'])){

                    include("delete_product.php");

                }
                
                if(isset($_GET['edit_product'])){

                    include("edit_product.php");

                }
                
                // product_categories
                
                if(isset($_GET['view_p_categories'])){

                    include("view_p_categories.php");

                }
                
                if(isset($_GET['insert_p_category'])){

                    include("insert_p_category.php");

                }
                
                if(isset($_GET['delete_p_cat'])){

                    include("delete_p_cat.php");

                }
                
                if(isset($_GET['edit_p_cat'])){

                    include("edit_p_cat.php");

                }
                
                // categories

                if(isset($_GET['view_cats'])){

                    include("view_cats.php");

                }
                
                if(isset($_GET['insert_cat'])){

                    include("insert_cat.php");

                }
                
                if(isset($_GET['edit_cat'])){

                    include("edit_cat.php");

                }
                
                if(isset($_GET['delete_cat'])){

                    include("delete_cat.php");

                }
                
                // slides
                
                if(isset($_GET['insert_slide'])){

                    include("insert_slide.php");

                }
                
                if(isset($_GET['view_slides'])){

                    include("view_slides.php");

                }
                
                if(isset($_GET['delete_slide'])){

                    include("delete_slide.php");

                }
                
                if(isset($_GET['edit_slide'])){

                    include("edit_slide.php");

                }
                
                // coupons
                
                if(isset($_GET['insert_coupon'])){

                    include("insert_coupon.php");

                }
                
                if(isset($_GET['view_coupons'])){

                    include("view_coupons.php");

                }
                
                if(isset($_GET['delete_coupon'])){

                    include("delete_coupon.php");

                }
                
                if(isset($_GET['edit_coupon'])){

                    include("edit_coupon.php");

                }

                // customers

                if(isset($_GET['view_customers'])){

                    include("view_customers.php");

                }
                
                if(isset($_GET['delete_customer'])){

                    include("delete_customer.php");

                }

                // order
                
                if(isset($_GET['view_orders'])){

                    include("view_orders.php");

                }
                
                if(isset($_GET['delete_order'])){

                    include("delete_order.php");

                }
                
                if(isset($_GET['confirm_yes'])){

                    include("confirm_yes.php");

                }
                
                if(isset($_GET['confirm_no'])){

                    include("confirm_no.php");

                }

                // user admin
                
                if(isset($_GET['view_users'])){

                    include("view_users.php");

                }
                
                if(isset($_GET['delete_user'])){

                    include("delete_user.php");

                }
                
                if(isset($_GET['user_profile'])){

                    include("user_profile.php");

                }
                
                if(isset($_GET['insert_user'])){

                    include("insert_user.php");

                }

            ?>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2022 <a href="">Quan and Thang</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>doanWeb</b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script src="js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea'});</script>
</body>
</html>
<?php } ?>