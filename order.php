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
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="css/order.css">
    <link rel="shortcut icon" href="images/logo.png" />
</head>
<body>

<?php

    if (!isset($_SESSION['customer_email'])) {

        echo "<script>window.open('customer/login.php','_self')</script>";
        
    } else {

    
?>

<?php

    if (isset($_GET['customer_id'])) {

        $customer_id = $_GET['customer_id'];

    }

    $ip_add = getRealIpUser();

    $status = "0";

    $get_cart = "select * from cart where ip_add='$ip_add'";

    $run_cart = mysqli_query($conn, $get_cart);

    while ($row_cart = mysqli_fetch_array($run_cart)) {

        $product_id = $row_cart['product_id'];

        $get_products = "select * from products where product_id='$product_id'";

        $run_products = mysqli_query($conn, $get_products);

        while ($row_products = mysqli_fetch_array($run_products)) {

            $sub_total = $row_products['product_price'];

            $insert_customer_order = "insert into customer_orders (customer_id, due_amount, product_id, order_date, order_status)
            values ('$customer_id','$sub_total', '$product_id', NOW(), '$status')";

            $run_customer_order = mysqli_query($conn, $insert_customer_order);

            $delete_cart = "delete from cart where ip_add='$ip_add'";

            $run_delete = mysqli_query($conn, $delete_cart);

            echo "
                <div class='popup'>
                <div class='popup__content'>
                    <div class='popup__image'>
                        <img src='assets/icon-location.svg' alt='>
                    </div>

                    <div class='popup__text'>
                        <h4 class='popup__title'>Đặt hàng thành công!</h4>
                        <p class='popup__desc'>Cảm ơn bạn đã đặt hàng</p>
                    </div>
                    
                    <a href='customer/my_account.php?my_orders' class='popup__btn'>Xem đơn hàng</a>
                </div>
            </div>
            ";
        }

    }

?>

<?php } ?>
</body>
</html>