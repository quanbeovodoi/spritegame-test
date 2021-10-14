<?php

    session_set_cookie_params('86400');
    session_start();
    include("includes/db.php");
    include("functions/functions.php");
?>

<?php error_reporting(0);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SpriteGameShop</title>
    <!--fonts-->
    
    <link rel="stylesheet" href="fonts/rougescript.css">
    <!--css swiper-->
    <link rel="stylesheet" href="css/swiper.min.css">
    <!--css-->
    <link rel="stylesheet" href="css/main.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- icon and title -->
    <link rel="shortcut icon" href="images/logo.png" />

    <meta name="keywords"
        content="quanbodoi, quanbodoi designer,graphic design,ui design,web design,wine labels,packaging design,label design,ui designer" />

    <meta property="og:title" content="Spritegame / portfolio" />
    <meta property="og:image" content="/images/fb_thumb.png" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/jquery-331.min.js"></script>
    
</head>
<body>
    <div id="preloder">
		<div class="loader">
        </div>
	</div>
    <!--Navigation-->
    <div class="menu-mobile">

        <div class="menu-items">
            <a href="index.php" class="menu-link">Trang chủ</a>
            <a href="shop.php" class="menu-link">Cửa hàng</a>
            <?php 
                 if (isset($_SESSION['customer_email']))
                 {
                     echo'<a href="customer/my_account.php?my_orders" class="menu-link">Tài khoản</a>';
                 }else{
                     echo'<a href="customer/login.php" class="menu-link">Tài khoản</a>';
                 }
                 ?>
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

    <!--Swiper-->
    <div class="swiper-container">
        <!--Additional required wrapper-->
        <div class="swiper-wrapper">
            <!--Slider-->
            <!-- php get slides -->
            <?php

                $get_slides = "select * from slides";

                $run_slides = mysqli_query($conn, $get_slides);

                while ($row_slides = mysqli_fetch_array($run_slides)) {

                    $slide_title = $row_slides['slide_title'];

                    $slide_description = $row_slides['slide_description'];

                    $slide_image = $row_slides['slide_image'];

                    $slide_url = $row_slides['slide_url'];
                
            
            ?>
            
            <div class="swiper-slide" style="background-image: url('admin/<?php echo $slide_image; ?>');">
                <div class="slide-text">
                    <h1><?php echo $slide_title; ?></h1>
                    <p><?php echo $slide_description; ?></p>
                    <?php

                        if ($slide_title=='') {

                            echo "";

                        } else {

                            echo "
                                <a href='shop.php'><button class='btn'>Mua Ngay</button></a>
                            ";
                        }
                    ?>
                    
                </div>
            </div>

            <?php } ?>
            <!-- end php get slides -->
            <!--end Slider-->

        </div>
        <!--if we need pagination-->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"><span></span></div>
        <div class="swiper-button-next"><span></span></div>

    </div>
    <!--end Swiper-->
    
    <!--Card-->
    <section class="wrapperCard">
        <h3 class="section__title">SpriteGame</h3>
        <!-- card-cate -->
        <div class="product-other">
            <h2 class="wrapperCard__title">Sản phẩm nổi bật</h2>
            <div class="cards">
                <!--card-->
                <!-- php get product -->
                <?php 

                    $get_products_cards = "SELECT * FROM products ORDER BY Rate DESC LIMIT 0, 4";

                    $run_products_cards = mysqli_query($conn, $get_products_cards);

                    while ($row_products_cards = mysqli_fetch_array($run_products_cards)) {

                        $product_id_cards = $row_products_cards['product_id'];

                        $product_title_cards = $row_products_cards['product_title'];

                        $product_price_cards = $row_products_cards['product_price'];

                        $product_image_1_cards = $row_products_cards['product_image_1'];

                        $product_label_cards = $row_products_cards['product_label'];

                        $product_sale_cards = $row_products_cards['product_sale'];

                
                ?>
                <a href="details.php?product_id=<?php echo $product_id_cards; ?>" rel="noopenner" class="card">
                    <?php
                        
                        if ($product_label_cards == "new") {

                            echo "<div class='new'>mới!</div>";

                        } else {

                            echo "<div class='sale'>giảm giá!</div>";

                        }

                    ?>
                    <div class="card__image">
                        <img src="admin/<?php echo $product_image_1_cards; ?>" alt="">
                    </div>

                    <div class="card__content">
                        <article class="card__text">
                            <h2 class="card__title"><?php echo $product_title_cards; ?></h2>
                            <div class="card__price">
                                <?php
                                
                                    if ($product_label_cards == "sale") {

                                        echo "
                                            <p class='card__priceFinal'>$product_sale_cards ₫</p>
                                            <p class='card__priceOriginal'>$product_price_cards  ₫</p>
                                        ";
                                    } else {

                                        echo "<p class='card__priceFinal'>$product_price_cards  ₫</p>";

                                    }

                                ?>
                            </div>
                        </article>

                        <div class="card__icon">
                            <p class="card__detail">Chi tiết<span>+</span></p>
                            <button class="btn"><span>Xem</span></button>
                        </div>
                    </div>
                </a>
                <?php } ?>
                <!-- end php get product -->
                <!--end Card-->
            </div>
        </div>
    <!-- end card-cate -->
        <h2 class="wrapperCard__title">Sản phẩm gần đây</h2>
        <div class="cards">
            <!--card-->
            <!-- php get product -->
            <?php 

                $get_products = "select * from products order by 1 DESC LIMIT 0, 8";

                $run_products = mysqli_query($conn, $get_products);

                while ($row_products = mysqli_fetch_array($run_products)) {

                    $product_id = $row_products['product_id'];

                    $product_title = $row_products['product_title'];

                    $product_price = $row_products['product_price'];

                    $product_image_1 = $row_products['product_image_1'];

                    $product_label = $row_products['product_label'];

                    $product_sale = $row_products['product_sale'];

            
            ?>
            <a href="details.php?product_id=<?php echo $product_id; ?>" rel="noopenner" class="card">
                <?php
                    
                    if ($product_label == "new") {

                        echo "<div class='new'>mới!</div>";

                    } else {

                        echo "<div class='sale'>giảm giá!</div>";

                    }

                ?>
                <div class="card__image">
                    <img src="admin/<?php echo $product_image_1; ?>" alt="">
                </div>

                <div class="card__content">
                    <article class="card__text">
                        <h2 class="card__title"><?php echo $product_title; ?></h2>
                        <div class="card__price">
                            <?php
                            
                                if ($product_label == "sale") {

                                    echo "
                                        <p class='card__priceFinal'>$product_sale ₫</p>
                                        <p class='card__priceOriginal'>$product_price  ₫</p>
                                    ";
                                } else {

                                    echo "<p class='card__priceFinal'>$product_price  ₫</p>";

                                }

                            ?>
                        </div>
                    </article>

                    <div class="card__icon">
                        <p class="card__detail">Chi tiết<span>+</span></p>
                        <button class="btn"><span>Xem</span></button>
                    </div>
                </div>
            </a>
            <?php } ?>
            <!-- end php get product -->
            <!--end Card-->
        </div>

        <a href="shop.php">
            <button class="button">Xem Thêm</button>
        </a>
        
    </section>
    <div class="chatbotArea" id="chatbotArea">
        <div class="icon-chatbot" id="iconChatbot" >
            <img src="chatbot/chat.png" alt="">
        </div>
        <div class="chatbot hidden">
            <div class="wrapper">
                    <div class="title">Tư vấn</div>
                    <div class="form">
                        <div class="bot-inbox inbox">
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="msg-header">
                                <p>Sprite Game web cung cấp tai nguyên làm game tại Việt Nam</p>
                            </div>
                        </div>
                    </div>
                    <div class="typing-field">
                        <div class="input-data">
                            <input id="data" type="text" placeholder="Hãy viết gì đó.." required>
                            <button id="send-btn">Gửi</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    
    <!--Footer-->
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
    <!--end Footer-->

    <!--script swiper-->
    <script src="js/swiper.min.js"></script>
    <!--script-->
    <script  src="js/main.js"></script>
    <script  src="js/mobile_menu.js"></script>
    <script>
            $(document).ready(function(){
                $("#send-btn").on("click", function(){
                    $value = $("#data").val();
                    $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                    $(".form").append($msg);
                    $("#data").val('');
                    
                    // start ajax code
                    $.ajax({
                        url: 'chatbot/message.php',
                        type: 'POST',
                        data: 'text='+$value,
                        success: function(result){
                            $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                            $(".form").append($replay);
                            // when chat goes down the scroll bar automatically comes to the bottom
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    });
                });
            });
        </script>
    <script>
        var mySwiper = new Swiper('.swiper-container', {
            autoplay: {
                delay: 5000,
            },
            effect: '',
            loop: true,
            speed: 1000,
            slidesPerView: 1,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: 'true'
            },
        });
    </script>
</body>
</html>