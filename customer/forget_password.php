<?php
    session_set_cookie_params('86400');
    session_start();
    include("../includes/db.php");
    include("../functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <!--fonts-->
    <link rel="stylesheet" href="fonts/rougescript.css">
    <!--css-->
    <link rel="stylesheet" href="../css/login.css">

</head>
<body>
<!--Navigation-->
    
    <div class="menu-mobile">

        <div class="menu-items">
            <a href="../index.php" class="menu-link">Trang chủ</a>
            <a href="../shop.php" class="menu-link">Cửa hàng</a>
            <a href="../register.php" class="menu-link">Tài khoản</a>
            <a href="../cart.php" class="menu-link">Giỏ hàng</a>
            <a href="#3" class="menu-link">Liên hệ</a>
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
                <a href="my_account.php?my_orders" class="menuLink">Tài khoản</a>
                <a href="../cart.php" class="menuLink">Giỏ hàng</a>
                <a href="#" class="menuLink">Liên hệ</a>
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
                        <a href='login.php'>
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

    <div class="modal" id='formlogin'>
        <div class="wrapper">
            <div id="vertification-yn"></div>
            <div class="content" id="contentID">
                
            </div>
        </div>
    </div>
    <!--end Content-->

    <!--script swiper-->
    <script src="../js/swiper.min.js"></script>
    <!--script-->
    <script src="../js/main.js"></script>
    <script  src="../js/mobile_menu.js"></script>
    <script src="../js/input_anime.js"></script>
    <script  src="js/search_open.js"></script>
    <script>
                    let templateLG = `
                    <div class="subtitle">Lấy Lại Mật Khẩu</div>
                <!--form-->
                <form action="password-reset-token.php" method="post" enctype="multipart/form-data">
                    
                    <div class="input-wrapper">
                        <label for="email">E-mail</label>
                        <input id="email" type="text" placeholder="Nhập email của bạn" name="customer_email" required>
                    </div>

                    <button name="password-reset-token" class="btn">Reset</button>
                </form>
                <!--end form-->`;
                    document.getElementById('contentID').insertAdjacentHTML('beforeend',templateLG);
                </script>
</body>
</html>
