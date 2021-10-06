<?php
session_set_cookie_params('86400');
session_start();
include("../includes/db.php");
include("../functions/functions.php");

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
/**
 * Description of vnpay_ajax
 *
 * @author xonv
 */
require_once("./config.php");
if (!isset($_SESSION['customer_email'])) {

    echo "<script>window.open('../customer/login.php','self')</script>";
    
} else {
if (isset($_GET['product_id']) && $_GET['order_id'] && $_GET['order_pass']) {

    $customer_email = $_SESSION['customer_email'];

    $order_id = $_GET['order_id'];
    $get_customer_order = "select * from customer_orders where order_id= '$order_id'";
    $run_customer_order = mysqli_query($conn, $get_customer_order);
    $row_customer_order = mysqli_fetch_array($run_customer_order);
    $cus_id = $row_customer_order['customer_id'];

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
        // $checkstate = mysqli_query($conn,"SELECT * FROM customer_orders WHERE order_status = 1 AND order_id= '$order_id' AND product_id = '$product_id' AND customer_id = '$cus_id'");
        // $rowcount=mysqli_num_rows($checkstate);
        // if($rowcount == 0){
            $updateState_pro = mysqli_query($conn,"UPDATE customer_orders SET order_status = 1 WHERE order_id= '$order_id' AND product_id = '$product_id' AND customer_id = '$cus_id'"); 
        //     $const = date("YmdHis");
        // }else{
        //     die('');
        // }
        $order_pass = date("YmdHis");
        $updateOrderPass_pro = mysqli_query($conn,"UPDATE customer_orders SET order_pass = $order_pass WHERE order_id= '$order_id' AND product_id = '$product_id' AND customer_id = '$cus_id'"); 
        $getorderPass = mysqli_query($conn,"SELECT * FROM customer_orders WHERE order_id= '$order_id' AND product_id = '$product_id' AND customer_id = '$cus_id'");
        $row_orderPass = mysqli_fetch_array($getorderPass);
    }
$vnp_TxnRef = $row_orderPass['order_pass']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = 'Thanh toan san pham '. $product_title;
$vnp_OrderType = 'billpayment';
$vnp_Amount = str_replace(',', '', $product_price*1000) * 100;
$vnp_Locale = 'vn';
$vnp_BankCode = $_POST['bank_code'];
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];


$inputData = array(
    "vnp_Version" => "2.0.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . $key . "=" . $value;
    } else {
        $hashdata .= $key . "=" . $value;
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
   // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
   	$vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
    $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
}

$returnData = array('code' => '00'
    , 'message' => 'success'
    , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
}