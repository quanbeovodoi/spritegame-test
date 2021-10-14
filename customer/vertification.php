<?php
    session_set_cookie_params('86400');
    session_start();
    include("../includes/db.php");
    include("../functions/functions.php");
    include('../mailsadooe/smtp/PHPMailerAutoload.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác thực Email</title>
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

    <div class="modal">
        <div class="wrapper">
            <div class="content">
                <div class="subtitle">Xác Thực Email</div>
                <!--form-->
                <form  method="post">
                    <div class="input-wrapper">
                        <label>E-mail</label>
                        <input id="email" type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" required>
                    </div>
                    <div class="input-wrapper">
                        <label>Mã xác thực</label>
                        <input id="password" type="text" placeholder="Nhập mã xác thực" name="verification_code">
                    </div>
                    <button type="submit" name="verify_email" class="btn">Xác Thực</button>
                    <button type="submit" style="margin-top: 15px;display: block;" name="verify_email_again" class="btn">Lấy lại mã xác thực</button>
                </form>
                <!--end form-->
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
<?php
    if (isset($_POST["verify_email"]))
    {
        $email = $_POST['email'];
        $get_customer = "select email_verified_at AS verEmail from customers where customer_email='$email'";

        $run_customer = mysqli_query($conn, $get_customer);

        $row_customer = mysqli_fetch_array($run_customer);

        if ($row_customer['verEmail'] != null) {

            echo "<script>alert('xac thuc roi')</script>";

            exit();

        } else{
            $email = $_POST["email"];
            $verification_code = $_POST["verification_code"];
 
            // mark email as verified
            $sql = "UPDATE customers SET email_verified_at = NOW() WHERE customer_email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
            $result  = mysqli_query($conn, $sql);
 
            if (mysqli_affected_rows($conn) == 0)
            {
                die("<script>alert('Mã xác thực không đúng')</script>");
            }
            else{
                echo "<script>alert('Xác thực thành công!');</script>";
                echo "<script>window.open('login.php','_self')</script>";
            }
            exit();
        }
    }
?>
</body>
</html>
<?php
if(isset($_POST["verify_email_again"])){
    $email = $_POST["email"];
    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $sql = "UPDATE customers SET verification_code = '".$verification_code."'  WHERE customer_email = '" . $email . "'";
    $result  = mysqli_query($conn, $sql);
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
        <p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">Chào bạn '.$customer_name.' Mã xác thực của quý khách là: '.$verification_code.'.</p><br>
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
    smtp_mailer($email,'Mã xác thực',$html);
    echo "<script>window.open('vertification.php?email=$email','_self')</script>";
} ?>
