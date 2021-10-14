
<?php
    session_set_cookie_params('86400');
    ob_start();
    session_start();
    include("../includes/db.php");
    include("../functions/functions.php");
    include('../mailsadooe/smtp/PHPMailerAutoload.php');
?>

<?php

    if (!isset($_SESSION['customer_email'])) {

        echo "<script>window.open('../customer/login.php','self')</script>";
        
    } else {
        function smtp_mailer($to,$subject, $msg){
            $mail = new PHPMailer(); 
            $mail->SMTPDebug  = 0;
            $mail->IsSMTP(); 
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; 
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Username = "shopgamesprite@gmail.com";
            $mail->Password = "0915196665";
            $mail->SetFrom("shopgamesprite@gmail.com");
            $mail->Subject = $subject;
            $mail->Body =$msg;
            $mail->AddAddress($to);
            $mail->SMTPOptions=array('ssl'=>array(
                'verify_peer'=>false,
                'verify_peer_name'=>false,
                'allow_self_signed'=>false
            ));
            if(!$mail->Send()){
                echo $mail->ErrorInfo;
            }else{
                return 'Sent';
            }
        }
        
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
        <title>Thông tin thanh toán</title>
        <!-- Bootstrap core CSS -->
        <link href="/SpritegameShop/payment/assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="/SpritegameShop/payment/assets/jumbotron-narrow.css" rel="stylesheet">         
        <script src="/SpritegameShop/payment/assets/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <?php
        require_once("./config.php");
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }

        //$secureHash = md5($vnp_HashSecret . $hashData);
		$secureHash = hash('sha256',$vnp_HashSecret . $hashData);
        ?>
        <!--Begin display -->
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">Thông tin đơn hàng</h3>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label >Mã đơn hàng:</label>
                    
                    <label><?php echo $_GET['vnp_TxnRef'] ?></label>
                </div>    
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label><?=number_format($_GET['vnp_Amount']/100) ?> VNĐ</label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Kết quả:</label>
                    <label>
                        <?php
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                $order_id = $_GET['vnp_TxnRef'];
                                $money = $_GET['vnp_Amount']/100;
                                $note = $_GET['vnp_OrderInfo'];
                                $vnp_response_code = $_GET['vnp_ResponseCode'];
                                $code_vnpay = $_GET['vnp_TransactionNo'];
                                $code_bank = $_GET['vnp_BankCode'];
                                $time = $_GET['vnp_PayDate'];
                                $date_time = substr($time, 0, 4) . '-' . substr($time, 4, 2) . '-' . substr($time, 6, 2) . ' ' . substr($time, 8, 2) . ' ' . substr($time, 10, 2) . ' ' . substr($time, 12, 2);
                                include("../includes/db.php");
                                $taikhoan = $_SESSION['customer_email'];
                                $sql = "SELECT * FROM payments WHERE order_id = '$order_id'";
                                $query = mysqli_query($conn, $sql);
                                $row = mysqli_num_rows($query);
                                
                                if ($row > 0) {
                                    $sql = "UPDATE payments SET order_id = '$order_id', money = '$money', note = '$note', vnp_response_code = '$vnp_response_code', code_vnpay = '$code_vnpay', code_bank = '$code_bank' WHERE order_id = '$order_id'";
                                   
                                    mysqli_query($conn, $sql);
                                } else {
                                    $sql = "INSERT INTO payments(order_id, thanh_vien, money, note, vnp_response_code, code_vnpay, code_bank, time) VALUES ('$order_id', '$taikhoan', '$money', '$note', '$vnp_response_code', '$code_vnpay', '$code_bank','$date_time')";
                                    mysqli_query($conn, $sql);
                                }
                                
                                echo "GD Thanh cong";
                            } else {
                                echo "GD Khong thanh cong";
                            }
                        } else {
                            echo "Chu ky khong hop le";
                        }
                        ?>
                    </label>
                    <br>
                    <label>
                        <?php
                        $updateState_pro = mysqli_query($conn,"UPDATE customer_orders SET order_status = 2 WHERE order_pass= '$order_id'");
                        if (isset($_SESSION['customer_email'])) {
                            $session_email = $_SESSION['customer_email'];
                            $get_customer = "select * from customers where customer_email='$session_email'";
                            $run_customer = mysqli_query($conn, $get_customer);
                            $row_customer = mysqli_fetch_array($run_customer);
                            $customer_name = $row_customer['customer_name'];
                    
                            $Query_Get_proID = mysqli_query($conn,"SELECT product_id FROM customer_orders WHERE order_pass= '$order_id'");
                            $row_Get_proID = mysqli_fetch_array($Query_Get_proID);
                            $Get_proID = $row_Get_proID['product_id'];
                    
                            $product_id = $Get_proID;
                            $get_product = "select linkURL from products where product_id = '$product_id'";
                            $run_product = mysqli_query($conn, $get_product);
                            $row_product = mysqli_fetch_array($run_product);
                                $linkdownload = $row_product['linkURL'];
                            // echo 'id la'.$product_id;
                            echo 'Link sản phẩm tải xuống <a href="'.$linkdownload.'">tại đây</a>';
                            $html='
                            <div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee">
                            <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                            <tbody>
                            <tr>
                            <td>
                            <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                            <tbody>
                            <tr>
                            <td>
                            <table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                            <tbody>
                            <tr>
                            <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0">
                            <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                            <td width="30"></td>
                            <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="https://spritegame.000webhostapp.com" target="_blank"><img src="https://spritegame.000webhostapp.com/assets/logo.png" alt="spritegame" ></a></td>
                            <td width="30"></td>
                            </tr>
                            </tbody>
                            </table>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="3" align="center">
                            <table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                            <td colspan="3" height="60"></td></tr><tr><td width="25"></td>
                            <td align="center">
                            <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Cảm ơn quý khách đã mua sản phẩm</h1>
                            </td>
                            <td width="25"></td>
                            </tr>
                            <tr>
                            <td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                            <p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">Cảm ơn quý khách hàng '.$customer_name.' đã mua sản phẩm của chúng tôi </p><br>
                            </td>
                            </tr>
                            <tr><td colspan="3" height="30"></td></tr>
                            </tbody>
                            </table>
                            </td>
                            </tr>
                            
                            
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            </div>';
                            smtp_mailer($session_email,'Cảm ơn vì đã mua sản phẩm',$html);
                            
                        }else{
                            echo "<script>window.open('../customer/login.php','self')</script>";
                        } 
                        ?>
                    </label>
                    <br>
                    <a href="../index.php">
                        <button>Quay lại</button>
                    </a>
                </div> 
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VnPay</p>
            </footer>
        </div>  
    </body>
</html>
<?php
    
 } ?>