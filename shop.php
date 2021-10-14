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
    <title>Cửa hàng</title>
    <!--fonts-->
    <link rel="stylesheet" href="fonts/rougescript.css">
    <!--script swiper-->
    <link rel="stylesheet" href="css/swiper.min.css">
    <!--css-->
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="stylesheet" href="css/shop.css">

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
                <a href="shop.php" class="menuLink active">Cửa hàng</a>
                <?php 
                 if (isset($_SESSION['customer_email']))
                 {
                     echo'<a href="customer/my_account.php?my_orders" class="menuLink">Tài khoản</a>';
                 }else{
                     echo'<a href="customer/login.php" class="menuLink">Tài khoản</a>';
                 }
                 ?>
                <a href="cart.php" class="menuLink">Giỏ hàng</a>
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
                <div class="control">
                    <div class="control__title">Danh Mục Sản Phẩm</div>
                    <div class="control__links">
                        <?php 

                        $get_product_category = "select * from product_categories";

                        $run_product_category = mysqli_query($conn, $get_product_category);

                        while($row_product_category = mysqli_fetch_array($run_product_category)) {

                            $product_category_id = $row_product_category['product_category_id'];

                            $product_category_title = $row_product_category['product_category_title'];

                            echo "
                                <a class='control__link' href='shop.php?product_category=$product_category_id'>$product_category_title</a>
                            ";
                        }

                        ?>
                        
                    </div>
                </div>
                <div class="control category">
                    <div class="control__title">Thể loại</div>
                    <div class="control__links">
                        <?php 

                        $get_category = "select * from categories";

                        $run_category = mysqli_query($conn, $get_category);

                        while($row_category = mysqli_fetch_array($run_category)) {

                            $category_id = $row_category['category_id'];

                            $category_title = $row_category['category_title'];

                            echo "
                                <a class='control__link' href='shop.php?category=$category_id'>$category_title</a>
                            ";
                        }
                        
                        ?>
                    </div>
                </div>
            </section>

            <section class="right">
                <!--Card-->
                <section class="wrapperCard">
                    <h3 class="section__title">SpriteGame</h3>
                    <div class="cards">
                        <!--card-->
                        <!-- php get product -->
                        <?php 
                        if (!isset($_GET['product_category'])) {
                            if (!isset($_GET['category'])) {

                                $per_page = 8;

                                if (isset($_GET['page'])) {
                                    
                                    $page = $_GET['page'];

                                } else {

                                    $page = 1;
                                }
                                
                            $start_from = ($page-1) * $per_page;

                            $get_products = "select * from products order by 1 DESC LIMIT $start_from, $per_page";

                            $run_products = mysqli_query($conn, $get_products);

                            while ($row_products = mysqli_fetch_array($run_products)) {

                                $product_id = $row_products['product_id'];

                                $product_title = $row_products['product_title'];

                                $product_price = $row_products['product_price'];

                                $product_image_1 = $row_products['product_image_1'];

                                $product_label = $row_products['product_label'];

                                $product_sale = $row_products['product_sale'];
                                
                                if ($product_label == 'new') {

                                    $label = "<div class='new'>mới!</div>";

                                } else {

                                    $label = "<div class='sale'>giảm giá!</div>";

                                }

                                if ($product_label == 'sale') {

                                    $price = " 
                                        <p class='card__priceFinal'>$product_sale ₫</p>
                                        <p class='card__priceOriginal'>$product_price ₫</p>
                                    ";

                                } else {

                                    $price = "<p class='card__priceFinal'>$product_price ₫</p>";

                                }

                                echo "
                                
                                    <a href='details.php?product_id=$product_id' rel='noopenner' class='card'>

                                    $label

                                    <div class='card__image'>
                                        <img src='admin/$product_image_1' alt=''>
                                    </div>
        
                                    <div class='card__content'>
                                        <article class='card__text'>
                                            <h2 class='card__title'>$product_title</h2>
                                            <div class='card__price'>
                                                $price
                                            </div>
                                        </article>
        
                                        <div class='card__icon'>
                                            <p class='card__detail'>Chi tiết<span>+</span></p>
                                            <button class='btn'><span>Xem</span></button>
                                        </div>
                                    </div>
                                </a>
                                ";

                            }
                        
                        ?>

                    <?php

                        }

                    }

                    ?>

                        <!-- end php get product -->
                        <?php get_p_category() ?>
                        <?php get_category() ?>
                        <!--end Card-->
                    </div>

                    <div class="pagination">

                    <?php 
                    
                        if (!isset($_GET['product_category'])) {
                            if (!isset($_GET['category'])) {

                                $get_products = "select * from products";

                                $run_products = mysqli_query($conn, $get_products);

                                $total_records = mysqli_num_rows($run_products);
                                
                                $total_pages = ceil($total_records / $per_page);
        
                                echo "<a class='pagination__link first' href='shop.php?page=1'><img src='assets/back.svg' alt=''></a>";
        
                                for ($i=1; $i<= $total_pages; $i++) {
                                    
                                    echo "<a class='pagination__link' href='shop.php?page=$i'>$i</a>";
                                }
        
                                echo "<a class='pagination__link last' href='shop.php?page=$total_pages'><img src='assets/next.svg' alt=''></a>";
                            }
                        }
                        
                    ?>

                    </div>
                    
                </section>
            </section>
        </div>
    </div>
    <div class="footerQ">
        <section class="footer">
            <div class="link-row">
                <div class="address-column">
                    <h3>SpriteGame</h3>
                    <p>Web cung cấp tài nguyên Game<br />Việt Nam 2021</p>
                </div>
                <div class="link-column">
                    <ul>
                        <li><span>Website</span></li>
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="shop.php">Cửa hàng</a></li>
                        <li><a href="cart.php">Giỏ hàng</a></li>
                        <li><a href="contacts.php">Liên hệ</a></li>
                    </ul>
                    <ul>
                        <li><span>Resources</span></li>
                        <li>
                        <a href="/knowledge-base" rel="noopener noreferrer">Knowledge Base</a>
                        </li>
                        <li>
                        <a href="/api-documentation" rel="noopener noreferrer"
                            >API Documentation</a
                        >
                        </li>
                        <li>
                            <a href="/developers" rel="noopener noreferrer">Developers</a>
                        </li>
                    </ul>
                    <ul>
                        <li><span>Sprite Game</span></li>
                        <li>
                            <a href="/our-story" rel="noopener noreferrer">My story</a>
                        </li>
                        <li><a href="/events" rel="noopener noreferrer">Sự kiện</a></li>
                        <li><a href="/careers" rel="noopener noreferrer">Tin tức</a></li>
                    </ul>
                </div>
            </div>
            <div class="social-row">
                <div class="copyright-column">
                <p>&copy; 2021 SpriteGame, Inc. All rights reserved.</p>
                </div>
                <div class="social-column">
                <a href="#" target="_blank" rel="noopener noreferrer">Tiktok</a>
                <a href="#" target="_blank" rel="noopener noreferrer">Twitter</a>
                <a href="#" target="_blank" rel="noopener noreferrer">Facebook</a>
                <a href="#" target="_blank" rel="noopener noreferrer">YouTube</a>
                </div>
            </div>
        </section>
    </div>
    <script src="js/main.js"></script>
    <script  src="js/mobile_menu.js"></script>
</body>
</html>