<?php

    session_set_cookie_params('86400');
    session_start();
    include("includes/db.php");
    include("functions/functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giỏ Hàng</title>
    <!--fonts-->
    <link rel="stylesheet" href="fonts/rougescript.css">
    <!--script swiper-->
    <link rel="stylesheet" href="css/swiper.min.css">
    <!--css-->
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="stylesheet" href="css/cart.css">

</head>
<body>
    <!--Navigation-->
    
    <div class="menu-mobile">

        <div class="menu-items">
            <a href="index.php" class="menu-link">Trang chủ</a>
            <a href="shop.php" class="menu-link">Cửa hàng</a>
            <a href="register.php" class="menu-link">Tài khoản</a>
            <a href="cart.php" class="menu-link">Giỏ hàng</a>
            <a href="contacts.php" class="menu-link">Liên hệ</a>
        </div>
        <div class="menu-icon close">
            <span></span>
        </div>

    </div>

    </div>
        
    <nav>

        <a href="index.php" class="mainLogo"> <img src="assets/logo.png" alt=""></a>
        <div class="menu">
            <div class="menulinks">
                <a href="index.php" class="menuLink">Trang chủ</a>
                <a href="shop.php" class="menuLink">Cửa hàng</a>
                <?php 
                 if (isset($_SESSION['customer_email']))
                 {
                     echo'<a href="customer/my_account.php?my_orders" class="menuLink">Tài khoản</a>';
                 }else{
                     echo'<a href="customer/login.php" class="menuLink">Tài khoản</a>';
                 }
                 ?>
                <a href="cart.php" class="menuLink active">Giỏ hàng</a>
                <a href="contacts.php" class="menuLink">Liên hệ</a>
            </div>
        </div>
        <div class="iconWrapper">

            <!-- Form search -->
            <form method="get" action="result.php">
                <div class="mainNav__input">
                    <input type="search" name="user_query" placeholder="Tìm kiếm ...">
                    <button class="mainNav__btnSearch" type="submit"> <img src="assets/icon-search.svg" alt=""></button>
                </div>
            </form>
            <!--end Form search-->
                
            <a href="cart.php">
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
                                <img src='customer/customer_images/customer_default.png' title='Đăng Nhập' alt=''>
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
                            <a href='customer/my_account.php?my_orders'>
                                <div class='profile'>
                                    <img src='customer/customer_images/customer_default_2.png' title='Xem Hồ Sơ' alt=''>
                                </div>
                            </a>
                        ";

                    } else {

                        echo "
                            <a href='customer/my_account.php?my_orders'>
                                <div class='profile'>
                                    <img src='customer/customer_images/$customer_image' title='Xem Hồ Sơ' alt=''>
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
            <!--form-->
            <form action="cart.php" method="post" enctype="multipart/form-data">
                <div class="mainTable">
                    <div class="wrapper_title">
                        <h3 class="section-title">Giỏ Hàng</h3>
                    </div>
                    <table>
                        <!--thead-->
                        <thead>

                            <tr>
                                <th colspan="2">Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Xoá</th>
                                <th>Giá</th>
                            </tr>

                        </thead>
                        <!--end thead-->

                        <!--tbody-->
                        <tbody>
                            
                            <?php
                            
                                $ip_add = getRealIpUser();

                                $get_cart = "select * from cart where ip_add='$ip_add'";

                                $run_cart = mysqli_query($conn, $get_cart);

                                $total = 0;

                                while ($row_cart = mysqli_fetch_array($run_cart)) {

                                    $product_id = $row_cart['product_id'];

                                    $product_price = $row_cart['p_price'];

                                    $get_products = "select * from products where product_id='$product_id'";

                                    $run_products = mysqli_query($conn, $get_products);

                                    while ($row_products = mysqli_fetch_array($run_products)) {

                                        $product_title = $row_products['product_title'];

                                        $product_image_1 = $row_products['product_image_1'];

                                        $sub_total = $product_price*1;

                                        $total = $total+$sub_total;


                            ?>

                            <tr>
                                <td><img class="table__image" src="admin/<?php echo $product_image_1; ?>" alt=""></td>
                                <td><a class="table__title" href="details.php?product_id=<?php echo $product_id; ?>"><?php echo $product_title; ?></a></td>
                                <td><?php echo $product_price; ?> ₫</td>
                                <td>
                                    <div class="check__box">

                                        <input type="checkbox" id="check" name="remove[]" value ="<?php echo $product_id; ?>">
                                        <label for="check"></label>
                                    </div>
                                </td>
                                <td><?php echo $sub_total; ?>.000 ₫</td>
                            </tr>

                        </tbody>

                            <?php } } ?>

                        <!--end tbody-->

                        <!--tfoot-->
                        <tfoot>

                            <tr>
                                <th colspan="4">Tổng giá</th>
                                <th colspan="2"><?php echo $total; ?>.000 ₫</th>
                            </tr>

                        </tfoot>
                        <!--end tfoot-->
                    </table>

                </div>
                <!--coupon-->
                <div class="coupon_wrapper">
                    <label for="coupon">Mã Giảm Giá</label>
                    <input type="text" id="coupon" name="code" class="coupon">
                    <button type="submit" name="apply_coupon" class="btn_coupon"><span>Sử dụng</span></button>
                </div>
                <!--end coupon-->

                <div class="foot__table">
                    <div class="btn">
                        <a href="index.php" class="btn__left">
                            <img src="assets/back-to-homepage.svg" alt="">
                            <span> Tiếp tục mua sắm</span>
                        </a>
                    </div>

                    <div class="btn">
                        <button class="btn__right" type="submit" name="update">
                            <img class="btn__image1" src="assets/update-products.svg" alt="">
                            <span>Cập nhật giỏ hàng</span>
                        </button>
                        <!-- php get customer_id -->
                        <?php
                            
                            if (isset($_SESSION['customer_email'])) {

                                $session_email = $_SESSION['customer_email'];

                                $get_customer = "select * from customers where customer_email='$session_email'";
        
                                $run_customer = mysqli_query($conn, $get_customer);
        
                                $row_customer = mysqli_fetch_array($run_customer);
        
                                    $customer_id = $row_customer['customer_id'];

                                    echo "
                                        <a href='order.php?customer_id= $customer_id' class='btn__right'>
                                            <span>Tiến hành đặt hàng</span>
                                            <img class='btn__image2' src='assets/go-to-pays.svg' alt=''>
                                        </a>
                                    ";
                            } else {

                                echo "
                                    <a href='customer/login.php' class='btn__right'>
                                        <span>Tiến hành đặt hàng</span>
                                        <img class='btn__image2' src='assets/go-to-pays.svg' alt=''>
                                    </a>
                            ";

                            }
                        
                        ?>
                        <!-- end php get customer_id -->
                    </div>
                </div>
            </form>
            <!--end form-->
            </section>

            <!-- php coupon -->
            <?php
            
                if (isset($_POST['apply_coupon'])) {

                    $code = $_POST['code'];

                    if ($code == "") {

                    } else {

                        $get_coupons = "select * from coupons where coupon_code='$code'";

                        $run_coupons = mysqli_query($conn, $get_coupons);

                        $check_coupons = mysqli_num_rows($run_coupons);

                        if ($check_coupons == "1") {

                            $row_coupons = mysqli_fetch_array($run_coupons);

                                $coupon_product_id = $row_coupons['product_id'];
                                
                                $coupon_price = $row_coupons['coupon_price'];

                                $coupon_limit = $row_coupons['coupon_limit'];

                                $coupon_used = $row_coupons['coupon_used'];

                                if ($coupon_limit == $coupon_used) {

                                    echo "<script>alert('Phiếu Giảm Giá Của Bạn Đã Hết Hạn')</script>";

                                } else {

                                    $get_cart = "select * from cart where product_id='$coupon_product_id' AND ip_add='$ip_add'";

                                    $run_cart = mysqli_query($conn, $get_cart);

                                    $check_cart = mysqli_num_rows($run_cart);

                                    if ($check_cart == "1") {

                                        $add_used = "update coupons set coupon_used=coupon_used+1 where coupon_code='$code'";

                                        $run_used = mysqli_query($conn, $add_used);

                                        $update_cart = "update cart set p_price='$coupon_price' where product_id='$coupon_product_id'";

                                        $run_update_cart = mysqli_query($conn, $update_cart);

                                        echo "<script>alert('Áp Dụng Thành Công')</script>";

                                        echo "<script>window.open('cart.php','_self')</script>";

                                    } else {

                                        echo "<script>alert('Sản Phẩm Không Áp Dụng Với Mã Giảm Giá Này')</script>";

                                    }

                                }

                        } else {

                            echo "<script>alert('Mã Giảm Giá Không Hợp Lệ')</script>";

                        }

                    }

                }
            
            ?>
            <!-- end php coupon -->


            <!-- php update_cart-->
            <?php

                function update_cart() {

                    global $conn;

                    if (isset($_POST['update'])) {
                        if(isset($_POST['remove'])){
                            foreach($_POST['remove'] as $remove_id) {

                                $delete_product = "delete from cart where product_id='$remove_id'";
    
                                $run_delete = mysqli_query($conn, $delete_product);
    
                                if ($run_delete) {
    
                                    echo "<script>window.open('cart.php','_self')</script>";
    
                                }
    
                            }
                        }
                        

                    }

                }

                echo $update_cart = update_cart();
            
            ?>
            <!-- end php update_cart-->

            <section class="right">
                <div class="rightContent">
                        
                    <div class="container anime">
                        <div class="receipt">
                            <div class="receipt__message">
                                <h2 class="receipt__title">Đơn hàng của bạn!</h2>
                                <p class="receipt__text">
                                    Vận chuyển và chi phí bổ sung được tính dựa trên giá trị bạn đã nhập
                                </p>
                                <a  href="customer/my_account.php?my_orders" class="btn">Xem đặt hàng</a>
                            </div>

                            <div class="price">

                                <div class="price__pricing">
                                    <p class="price__princingTitle">
                                    Tổng phụ
                                    </p>
                                    <p class="price__princingNumber">
                                        <?php echo $total; ?>.000 ₫
                                    </p>

                                </div>
                                <div class="price__pricing">
                                    <p class="price__princingTitle">
                                    Phí vận chuyển
                                    </p>
                                    <p class="price__princingNumber">
                                        0 ₫
                                    </p>

                                </div>

                                <div class="price__total">
                                    <p class="price__totalTile">
                                        Total
                                    </p>
                                    <p class="price__totalNumber">
                                        <?php echo $total; ?>.000 ₫
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!--script swiper-->
    <script src="js/swiper.min.js"></script>
    <!--script-->
    <script src="js/main.js"></script>
    <script  src="js/mobile_menu.js"></script>

    <script src="js/jquery-331.min.js"></script>

    <script>

    $(document).ready(function(data) {

        $(document).on('keyup','.quantity',function() {

                var id = $(this).data("product_id");
                var quantity = $(this).val();
                if(quantity !='') {

                    $.ajax({

                        url: "change.php",
                        method: "POST",
                        data:{id:id, quantity:quantity},

                        success:function() {
                            $("body").load("cart.php");
                        }

                    });

                }

        });

    });

    </script>
</body>
</html>