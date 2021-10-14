<?php
if(isset($_POST['password-reset-token']) && $_POST['customer_email'])
{
    include("../includes/db.php");
     
    $emailId = $_POST['customer_email'];
 
    $result = mysqli_query($conn,"SELECT * FROM customers WHERE customer_email='" . $emailId . "'");
 
    $row= mysqli_fetch_array($result);

  //   $customer_password = password_hash($_POST['customer_password'],PASSWORD_DEFAULT);

  //   if (!password_verify($_POST['customer_repassword'],$customer_password)) {

  //     echo "<script>alert('Mật Khẩu Nhập Lại Chưa Đúng')</script>";

  //     exit();

  // }
 
  if($row)
  {
     
    $token = md5($emailId).rand(10,9999);
 
    $update = mysqli_query($conn,"UPDATE customers set reset_link_token='" . $token . "' ");
    if($_SERVER['SERVER_NAME']=='localhost')
    {
      $nameServer = "localhost/SpritegameShop";
    }else{
      $nameServer = $_SERVER['SERVER_NAME'];
    }
    $link = "<a href='http://".$nameServer."/customer/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";
 
    include('../mailsadooe/smtp/PHPMailerAutoload.php');
    $oke = false;
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
      //  echo $mail->ErrorInfo;
      return false;
      }else{
        return true;
       }
    }
    if (isset($_POST['customer_email'])) {
      $get_customer = "select * from customers where customer_email='$emailId'";
      $run_customer = mysqli_query($conn, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);
        $customer_name = $row_customer['customer_name'];
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
        <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Password</h1>
        </td>
        <td width="25"></td>
        </tr>
        <tr>
        <td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
        <p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">Chào bạn'.$customer_name.', Reset mật khẩu tại đây : '.$link.'.</p><br>
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
        $oke = smtp_mailer($emailId,'Lấy lại mật khẩu',$html);
      
    }

  }else{
    echo "Invalid Email Address. Go back";
  }
}
if($oke == true){
  echo "<script>alert('Link reset password đã được gửi về email')</script>";
  echo "<script>window.open('login.php','_self')</script>";
}else{
  echo "<script>alert('Lỗi gửi email')</script>";
  echo "<script>window.open('../index.php','_self')</script>";
}
?>