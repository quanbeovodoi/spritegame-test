<?php
    session_set_cookie_params('86400');
    session_start();
    include("../includes/db.php");
    include("../functions/functions.php");

?>

<?php

    if (!isset($_SESSION['customer_email'])) {

        echo "<script>window.open('../customer/login.php','self')</script>";
        
    } else {

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tạo mới đơn hàng</title>
        <!-- Bootstrap core CSS -->
        <link href="/SpritegameShop/payment/assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="/SpritegameShop/payment/assets/jumbotron-narrow.css" rel="stylesheet">  
        <script src="/SpritegameShop/payment/assets/jquery-1.11.3.min.js"></script>
    </head>

    <body>

    <?php
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    // $get_customer_order = "select * from customer_orders where order_id= '$order_id'";
    // $run_customer_order = mysqli_query($conn, $get_customer_order);
    // $row_customer_order = mysqli_fetch_array($run_customer_order);
    // $cus_id = $row_customer_order['customer_id'];
}
if (isset($_GET['product_id'])) {
    // $customer_email = $_SESSION['customer_email'];

    // $get_customer = "select * from customers where customer_email= '$customer_email'";

    // $run_customer = mysqli_query($conn, $get_customer);

    // $row_customer = mysqli_fetch_array($run_customer);

        // $cus_id = $row_customer['customer_id'];

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

        $order_pass = $_GET['order_pass'];
        $updateOrderPass_pro = mysqli_query($conn,"UPDATE customer_orders SET order_pass = $order_pass WHERE order_id= '$order_id'"); 
        $getorderPass = mysqli_query($conn,"SELECT * FROM customer_orders WHERE order_id= '$order_id'");
        $row_orderPass = mysqli_fetch_array($getorderPass);

}
?>
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VnPay</h3>
            </div>
            <div class="table-responsive">
                <form action="/SpritegameShop/payment/vnpay_create_payment.php?product_id=<?php echo $product_id; ?>&order_id=<?php echo $order_id; ?>&order_pass=<?php echo $row_orderPass['order_pass'];?>" id="create_form" method="post">       

                    <h1>Thanh toán hoá đơn</h1>
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <input class="form-control" type="number" value="<?php echo $product_price ?>" disabled/>
                    </div>
                    
                    <div class="form-group">
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Không chọn</option>
                            <option value="NCB"> Ngan hang NCB</option>
                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                            <option value="SCB"> Ngan hang SCB</option>
                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                            <option value="MSBANK"> Ngan hang MSBANK</option>
                            <option value="NAMABANK"> Ngan hang NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                            <option value="HDBANK">Ngan hang HDBank</option>
                            <option value="DONGABANK"> Ngan hang Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngan hang VPBank</option>
                            <option value="MBBANK"> Ngan hang MBBank</option>
                            <option value="ACB"> Ngan hang ACB</option>
                            <option value="OCB"> Ngan hang OCB</option>
                            <option value="IVB"> Ngan hang IVB</option>
                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        </select>
                    </div>
                    <button type="submit" name="redirect" id="redirect" class="btn btn-default">Thanh toán</button>

                </form>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; Thanh toán VNPAY </p>
            </footer>
        </div>  
        <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
        <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
        <!-- <script type="text/javascript">
            $("#btnPopup").click(function () {
                var postData = $("#create_form").serialize();
                var submitUrl = $("#create_form").attr("action");
                $.ajax({
                    type: "POST",
                    url: submitUrl,
                    data: postData,
                    dataType: 'JSON',
                    success: function (x) {
                        if (x.code === '00') {
                            if (window.vnpay) {
                                vnpay.open({width: 768, height: 600, url: x.data});
                            } else {
                                location.href = x.data;
                            }
                            return false;
                        } else {
                            alert(x.Message);
                        }
                    }
                });
                return false;
            });
        </script> -->


    </body>
</html>
<?php
}?>