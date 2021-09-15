<?php
    session_set_cookie_params('86400');
    session_start();
    include("../includes/db.php");
    include("../functions/functions.php");

?>

<?php

    if (!isset($_SESSION['customer_email'])) {

        echo "<script>window.open('login.php','self')</script>";
        
    } else {

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>my account</title>
    <!--fonts-->
    <link rel="stylesheet" href="fonts/rougescript.css">
    <!--script swiper-->
    <link rel="stylesheet" href="css/swiper.min.css">
    <!--css-->
    <link rel="stylesheet" href="css/my_account.css">
    <link rel="shortcut icon" href="../images/logo.png" />

</head>
<body>
<!--Navigation-->
    
    <div class="menu-mobile">

        <div class="menu-items">
            <a href="../index.php" class="menu-link">Trang chủ</a>
            <a href="../shop.php" class="menu-link">Cửa hàng</a>
            <a href="../register.php" class="menu-link">Tài khoản</a>
            <a href="../cart.php" class="menu-link">Giỏ hàng</a>
            <a href="../contacts.php" class="menu-link">Liên hệ</a>
        </div>
        <div class="menu-icon close">
            <span></span>
        </div>

    </div>

    </div>
        
    <nav>

        <a href="../index.php" class="mainLogo"> <img src="assets/logo.png" alt=""></a>
        <div class="menu">
            <div class="menulinks">
                <a href="../index.php" class="menuLink">Trang chủ</a>
                <a href="../shop.php" class="menuLink">Cửa hàng</a>
                <a href="my_account.php?my_orders" class="menuLink active">Tài khoản</a>
                <a href="../cart.php" class="menuLink">Giỏ hàng</a>
                <a href="../contacts.php" class="menuLink">Liên hệ</a>
            </div>
        </div>
        <div class="iconWrapper">

            <!-- Form search -->
            <form method="get" action="../result.php">
                <div class="mainNav__input">
                    <input type="search" name="user_query" placeholder="Tìm kiếm ...">
                    <button class="mainNav__btnSearch" type="submit"> <img src="../assets/icon-search.svg" alt=""></button>
                </div>
            </form>
            <!--end Form search-->
                
            <a href="../cart.php">
                <div class="shoppingCart">
                    <img src="assets/shopping-cart.svg" alt="">
                    <span class="itemNumber"><?php items(); ?></span>
                </div>
            </a>

            <?php
            
                if (!isset($_SESSION['customer_email'])) {

                    echo "
                        <a href='customer/login.php'>
                            <div class='profile'>
                                <img src='customer_images/customer_default.png' title='Đăng Nhập' alt=''>
                            </div>
                        </a>
                    ";

                } else {

                    $session_email = $_SESSION['customer_email'];

                    $get_customer = "select * from customers where customer_email='$session_email'";

                    $run_customer = mysqli_query($conn, $get_customer);

                    $row_customer = mysqli_fetch_array($run_customer);

                        $customer_name = $row_customer['customer_name'];

                        $customer_image = $row_customer['customer_image'];
                        
                    if ($customer_image=='') {

                        echo "
                            <a href='my_account.php?my_orders'>
                                <div class='profile'>
                                    <img src='customer_images/customer_default_2.png' title='Xem Hồ Sơ' alt=''>
                                </div>
                            </a>
                        ";

                    } else {

                        echo "
                            <a href='my_account.php?my_orders'>
                                <div class='profile'>
                                    <img src='customer_images/$customer_image' title='Xem Hồ Sơ' alt=''>
                                </div>
                            </a>
                        ";
                    }
                }
            
            ?>

            <div class="menu-icon open">
                <span></span>
            </div>
        </div>
    </nav>
    <!--end Navigation-->

    <!--Content-->
    <div class="wrapper">
        
        <div class="content">
            <section class="left">
                <div class="leftContent">
                
                <?php

                    $session_email = $_SESSION['customer_email'];

                    $get_customer = "select * from customers where customer_email='$session_email'";

                    $run_customer = mysqli_query($conn, $get_customer);

                    $row_customer = mysqli_fetch_array($run_customer);

                    $customer_id = $row_customer['customer_id'];

                    $customer_name = $row_customer['customer_name'];

                    $customer_email = $row_customer['customer_email'];

                    $customer_phone = $row_customer['customer_phone'];

                    $customer_address = $row_customer['customer_address'];

                    $customer_image_origin = $row_customer['customer_image'];

                    if ($customer_image_origin=='') {
                        
                        echo "

                            <div class='avatar'>
                                <img src='customer_images/customer_default_2.png' alt=''>
                            </div>

                        ";

                    } else {

                        echo "

                        <div class='avatar'>
                            <img src='customer_images/$customer_image_origin' alt=''>
                        </div>

                    ";
                    }
            
                ?>

                    <div class="info__customer">
                        <?php echo $customer_name; ?>
                    </div>

                    <a href="my_account.php?my_orders" class="panel">
                        <img src="assets/icon-don-hang-cua-toi.svg" alt="">
                        <div class="panel__link">Đơn Hàng Của Tôi</div>
                    </a>

                    <a href="my_account.php?pay_offline" class="panel">
                        <img src="assets/icon-thanh-toan.svg" alt="">
                        <div class="panel__link">Thanh Toán Ngoại Tuyến</div>
                    </a>

                    <a href="my_account.php?edit_account" class="panel">
                        <img src="assets/icon-edit.svg" alt="">
                        <div class="panel__link">Chỉnh Sửa Tài Khoản</div>
                    </a>

                    <a href="my_account.php?change_password" class="panel">
                        <img src="assets/icon-doi-mat-khau.svg" alt="">
                        <div class="panel__link">Đổi Mật Khẩu</div>
                    </a>

                    <a href="my_account.php?delete_account" class="panel">
                        <img src="assets/icon-xoa-tai-khoan.svg" alt="">
                        <div class="panel__link">Xoá Tài Khoản</div>
                    </a>

                    <a href="logout.php" class="panel">
                        <img src="assets/icon-dang-xuat.svg" alt="">
                        <div class="panel__link">Đăng Xuất</div>
                    </a>
                    
                </div>
            </section>

            <section class="right">
                <div class="rightContent">

                    <?php

                        if (isset($_GET['my_orders'])) {

                            include("my_orders.php");
                            
                        }
                    
                    ?>
                    
                    <?php

                        if (isset($_GET['pay_offline'])) {

                            include("pay_offline.php");
                            
                        }
                
                    ?>
                    
                    <?php

                        if (isset($_GET['edit_account'])) {

                            include("edit_account.php");
                            
                        }
                
                    ?>
                    
                    <?php

                        if (isset($_GET['change_password'])) {

                            include("change_password.php");
                            
                        }
                
                    ?>
                    
                    <?php

                        if (isset($_GET['delete_account'])) {

                            include("delete_account.php");
                            
                        }
                
                    ?>

                </div>
            </section>

        </div>
        <!--end Content-->
    </div>

    <!--script swiper-->
    <script src="../js/swiper.min.js"></script>
    <!--script-->
    <script src="../js/main.js"></script>
    <script  src="../js/mobile_menu.js"></script>
    <script  src="../js/choose_picture.js"></script>
    <script  src="js/search_open.js"></script>

</body>
</html>
<?php } ?>