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
    <title>Chi tiết</title>
    <!--fonts-->
    <link rel="stylesheet" href="fonts/rougescript.css">
    <!--script swiper-->
    <link rel="stylesheet" href="css/swiper.min.css">
    <!--css-->
    <link rel="stylesheet" href="css/details.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<!-- php get product your chose -->
<?php
if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];

    $get_product = "select * from products where product_id = '$product_id'";

    $run_product = mysqli_query($conn, $get_product);

    $row_product = mysqli_fetch_array($run_product);

        $product_title = $row_product['product_title'];

        $product_price = $row_product['product_price'];

        $product_image_1 = $row_product['product_image_1'];

        $product_image_2 = $row_product['product_image_2'];

        $product_image_3 = $row_product['product_image_3'];

        $product_description = $row_product['product_description'];

        $product_label = $row_product['product_label'];

        $product_sale = $row_product['product_sale'];

        $product_rated = $row_product['Rate'];
    //comment


}
if(isset($_SESSION['customer_email'])){
    $session_email = $_SESSION['customer_email'];
    $get_customer = "select * from customers where customer_email='$session_email'";
    $run_customer = mysqli_query($conn, $get_customer);
    $row_customer = mysqli_fetch_array($run_customer);
    $customer_name = $row_customer['customer_name'];
    $customer_img = $row_customer['customer_image'];
}

?>
<!-- end php get product your chose -->
<body  onload="showRestaurantData('rating/getRatingDataOnlyOne.php?product_id=<?php echo $product_id; ?>')">
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
                <div class="swiper-container galleryMain">
                    
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="scene"> 
                                <img src="admin/<?php echo $product_image_1; ?>" alt="đang tải...">
                                <img src="admin/<?php echo $product_image_1; ?>" class="shadow">
                            </div>
                        </div>
                        
                        <div class="swiper-slide">
                            <div class="scene"> 
                                <img src="admin/<?php echo $product_image_2; ?>" alt="đang tải...">
                                <img src="admin/<?php echo $product_image_2; ?>" class="shadow">
                            </div>
                        </div>
                        
                        <div class="swiper-slide">
                            <div class="scene"> 
                                <img src="admin/<?php echo $product_image_3; ?>" alt="đang tải...">
                                <img src="admin/<?php echo $product_image_3; ?>" class="shadow">
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="rateStar">
                    <div class="rating">
                        <div class="row-item" style="border:none; text-align: center;">
                            <ul class="list-inline">
                                 <!--vong for neu có sao thi selected neu ko thi de ko  -->
                                 <?php
                                 for ($count = 1; $count <= 5; $count ++){
                                     if($count <= $product_rated){
                                        echo'<li class="star selected">★</li>';
                                     }else{
                                        echo'<li class="star">★</li>';
                                     }
                                 }
                                  ?>
                                <!-- <li id="4_1" class="star selected" value="1">★</li>
                                <li id="4_2" class="star selected" value="2">★</li>
                                <li id="4_3" class="star selected" value="3">★</li>
                                <li id="4_4" class="star selected" value="4">★</li>
                                <li id="4_5" class="star" value="5">★</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                    $avgQuery="SELECT AVG(ratingnumber) AS rateRow FROM ratestart";
                    $avg=mysqli_query($conn, $avgQuery);
                    $ratingsum = $avg;
                    $math_rate = mysqli_fetch_assoc($ratingsum);
                 ?>
                <!--Add Arrows-->
                <div class="sliderNavigation">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </section>

            <section class="right">
                <div class="rightContent">
                    <div class="model">
                        <p class="modelTitle"><?php echo $product_title; ?></p>
                        <p class="modelDesc"><?php echo $product_description; ?></p>
                    </div>

                    <div class="price">
                        <?php
                        
                            if ($product_label == "sale") {

                                echo "
                                    <p class='priceFinal'>$product_sale ₫</p>
                                    <p class='priceOriginal'>$product_price ₫</p>
                                ";
                            } else {

                                echo "<p class='priceFinal'>$product_price ₫</p>";

                            }
                        
                        ?>
                    </div>

                    <div class="specs">
                        <div class="size">
                        <h3 class="subtitle">Đánh giá Sản phẩm</h3>
                        <div class="rating">
                            <div class="container">
                                <?php if(isset($_SESSION['customer_email'])){
                                    echo '<span id="restaurant_list"></span>';
                                }else{
                                    echo '<span>Đăng nhập để đánh giá sản phẩm</span>';
                                }?>
                                </div>
                            </div>
                            <!--Form-->
                            <?php add_cart(); ?>
                            <form action="details.php?add_cart=<?php echo $product_id; ?>" method="post">
                        </div>
                    </div>
                    <button class="btn" type="submit">
                        <img src="assets/shopping-cart-w.svg" alt="">
                        <span>thêm vào giỏ</span>
                    </button>
                            </form>
                            <!--end Form-->
                </div>
            </section>
        </div>
        <!--end Content-->
        <!-- comment -->
        <div class="d-flex align-items-center justify-content-center">
            <div class="cmt">
                <div class="form">
                    <div class="bot-inbox inbox">
                        <h3 class="TitleCmt row justify-content-center mb-4">Bình luận</h3>
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="comment-form d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-sm rounded-circle">
                                            <?php if(isset($_SESSION['customer_email'])){
                                                echo "<img class='avatar-img' src='customer/customer_images/$customer_image' alt=''>";
                                            }else{
                                                echo "<img class='avatar-img' src='customer/customer_images/customer_default_2.png' alt=''>";
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-sm-3">
                                            <textarea id="data" class="form-control py-0 px-1 border-0" rows="1" placeholder="Viết Bình Luận..." style="resize: none;"></textarea>
                                            <button class="btn-2" id="send-btn">Đăng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="width:100%;height:20px;padding:10px"></div>
                        <div class="msg-header row justify-content-center mb-4">
                            <div class="col-lg-8">
                                <!-- comment content -->
                                <div class="comments">
                                    <!-- <div class="comment d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm rounded-circle">
                                                <img class="avatar-img" src="https://uifaces.co/our-content/donated/AW-rdWlG.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2 ms-sm-3">
                                            <div class="comment-meta d-flex align-items-baseline">
                                                <h6 class="me-2">Jordan Singer</h6>
                                                <span class="text-muted">2d</span>
                                            </div>
                                            <div class="comment-body">
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non minima ipsum at amet doloremque qui magni, placeat deserunt pariatur itaque laudantium impedit aliquam eligendi repellendus excepturi quibusdam nobis esse accusantium.
                                            </div>
                            
                                            <div class="comment-replies bg-light p-3 mt-3 rounded">
                                                <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>
                            
                                                <div class="reply d-flex mb-4">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar avatar-sm rounded-circle">
                                                            <img class="avatar-img" src="https://images.unsplash.com/photo-1501325087108-ae3ee3fad52f?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=faces&amp;fit=crop&amp;h=200&amp;w=200&amp;s=f7f448c2a70154ef85786cf3e4581e4b" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2 ms-sm-3">
                                                        <div class="reply-meta d-flex align-items-baseline">
                                                            <h6 class="mb-0 me-2">Brandon Smith</h6>
                                                            <span class="text-muted">2d</span>
                                                        </div>
                                                        <div class="reply-body">
                                                            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="reply d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar avatar-sm rounded-circle">
                                                            <img class="avatar-img" src="https://uifaces.co/our-content/donated/6f6p85he.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2 ms-sm-3">
                                                        <div class="reply-meta d-flex align-items-baseline">
                                                            <h6 class="mb-0 me-2">James Parsons</h6>
                                                            <span class="text-muted">1d</span>
                                                        </div>
                                                        <div class="reply-body">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio dolore sed eos sapiente, praesentium.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <?php
                                        $get_comment = "select * from comments where product_id = '$product_id' order by id DESC";
                                        $run_comment = mysqli_query($conn, $get_comment);
                                        while ($row_comment = mysqli_fetch_array($run_comment)){
                                        $cus_id = $row_comment['id_cus'];
                                        $cus_comment = $row_comment['comment'];
                                        $date_comment = $row_comment['date'];
                                        $get_customer = "select * from customers where customer_id='$cus_id'";
                                        $run_customer = mysqli_query($conn, $get_customer);
                                        $row_customer = mysqli_fetch_array($run_customer);
                                        $customer_name = $row_customer['customer_name'];
                                        $customer_image = $row_customer['customer_image'];
                                    ?>
                                    <div class="comment d-flex  mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm rounded-circle">
                                                <img class="avatar-img" src="customer/customer_images/<?php echo $customer_image ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-1 ms-2 ms-sm-3">
                                            <div class="comment-meta d-flex">
                                                <h6 class="me-2"><?php echo $customer_name ?></h6>
                                                <span class="text-muted">
                                                    <?php
                                                        $dt = new DateTime($date_comment);
                                                        echo $dt->format('Y-m-d');
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="comment-body">
                                                <?php echo $cus_comment ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    
                                </div>
                                <!-- end comment content -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="typing-field ">
                    <div class="input-data">
                        <input id="data" type="text" placeholder="Viết gì đó..." required>
                        <button class="btn-2" id="send-btn">Gửi</button>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- end comment -->
        
    </div>

    <!--script swiper-->
    <script src="js/swiper.min.js"></script>
    <!--script-->
    <script src="js/main.js"></script>
    <script  src="js/mobile_menu.js"></script>
    <script>
        // swiper   
        var mySwiper = new Swiper('.swiper-container', {
            effect: '',
            loop: false,
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
    <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<p>'+ $value +'</p>';
                $img = 'customer/customer_images/<?php if(isset($_SESSION['customer_email'])){echo $customer_img;}else{echo 'customer_default_2.png';}  ?>';
                $("#data").val('');
                if($value != null && $value != '' ){
                        $.ajax({
                        url: 'comments.php',
                        type: 'POST',
                        data: {text: $value,product_id: <?php echo $product_id?>},
                        success: function(result){
                            $replay = '<div class="comment d-flex  mb-4"><div class="flex-shrink-0"><div class="avatar avatar-sm rounded-circle"><img class="avatar-img" src="' + $img + '" alt=""></div></div><div class="flex-shrink-1 ms-2 ms-sm-3"><div class="comment-meta d-flex"><h6 class="me-2"><?php if(isset($_SESSION['customer_email'])){echo $customer_name;}else{echo 'Người dùng';} ?></h6><span class="text-muted">4d</span></div><div class="comment-body">'+ result +'</div></div></div>';
                            $(".form .msg-header .comments").prepend($replay);
                        }
                    });
                }
            });
        });
    </script>

</body>
</html>
<script type="text/javascript">
function showRestaurantData(url)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById("restaurant_list").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();

} 

function mouseOverRating(restaurantId, rating) {

    resetRatingStars(restaurantId)

    for (var i = 1; i <= rating; i++)
    {
        var ratingId = restaurantId + "_" + i;
        document.getElementById(ratingId).style.color = "#ff6e00";

    }
}

function resetRatingStars(restaurantId)
{
    for (var i = 1; i <= 5; i++)
    {
        var ratingId = restaurantId + "_" + i;
        document.getElementById(ratingId).style.color = "#9E9E9E";
    }
}

function mouseOutRating(restaurantId, userRating) {
    var ratingId;
    if(userRating !=0) {
            for (var i = 1; i <= userRating; i++) {
                    ratingId = restaurantId + "_" + i;
                    document.getElementById(ratingId).style.color = "#ff6e00";
            }
    }
    if(userRating <= 5) {
            for (var i = (userRating+1); i <= 5; i++) {
                ratingId = restaurantId + "_" + i;
                document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }
}

function addRating (restaurantId, ratingValue) {
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200) {

                showRestaurantData('rating/getRatingDataOnlyOne.php?product_id=<?php echo $product_id; ?>');
                                                
                if(this.responseText != "success") {
                    alert(this.responseText);
                }
            }
        };

        xhttp.open("POST", "rating/insertRating.php", true);
         xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var parameters = "index=" + ratingValue + "&product_id=" + restaurantId;
        xhttp.send(parameters);
}
</script>