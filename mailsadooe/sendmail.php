<?php
session_set_cookie_params('86400');
session_start();
include('smtp/PHPMailerAutoload.php');
include('../includes/db.php');
include('../functions/functions.php');
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
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
if (isset($_SESSION['customer_email'])) {
	$session_email = $_SESSION['customer_email'];
	$get_customer = "select * from customers where customer_email='$session_email'";
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
    <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://discussdesk.com//" target="_blank"><img src="http://discussdesk.com//view/assets/images/logo.png" alt="discussdesk" ></a></td>
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
    <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">C???m ??n qu?? kh??ch ???? mua s???n ph???m</h1>
    </td>
    <td width="25"></td>
    </tr>
    <tr>
    <td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
    <p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">Ch??o b???n'.$customer_name.',
        C???m ??n b???n ???? mua s???n ph???m! H??y ???ng h??? ch??ng t??i b???ng c??ch mua nhi???u s???n ph???m h??n n???a C???m ??n qyas kh??ch r???t nhi???u.
        N???u c?? th???c m???c, vui l??ng li??n h??? B??? ph???n Ch??m s??c kh??ch h??ng t???i: abcxyz.</p><br>
    </td>
    </tr>
    <tr>
    <td colspan="4">
    <div style="width:100%;text-align:center;margin:30px 0">
    <table align="center" cellpadding="0" cellspacing="0" style="font-family:HelveticaNeue-Light,Arial,sans-serif;margin:0 auto;padding:0">
    <tbody>
    <tr>
    <td align="center" style="margin:0;text-align:center"><a href="#" style="font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Mua ti???p!</a></td>
    </tr>
    </tbody>
    </table>
    </div>
    </td>
    </tr>
    <tr><td colspan="3" height="30"></td></tr>
    </tbody>
    </table>
    </td>
    </tr>
    
    <tr bgcolor="#ffffff">
    <td width="30" bgcolor="#eeeeee"></td>
    <td width="30" bgcolor="#eeeeee"></td>
    </tr>
    </tbody>
    </table>
    <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
    <tbody>
    <tr>
    <td>
    <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
    <tbody>
    <tr><td colspan="2" height="30"></td></tr>
    <tr>
    <td width="360" valign="top">
    <div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">&copy; 2021 discussesk. All rights reserved.</div>
    <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
    <div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">Made in VietNam</div>
    </td>
    <td align="right" valign="top">
    <span style="line-height:20px;font-size:10px"><a href="#" target="_blank"><img src="https://i.imgbox.com/BggPYqAh.png" alt="fb"></a>&nbsp;</span>
    <span style="line-height:20px;font-size:10px"><a href="#" target="_blank"><img src="https://i.imgbox.com/j3NsGLak.png" alt="twit"></a>&nbsp;</span>
    <span style="line-height:20px;font-size:10px"><a href="#" target="_blank"><img src="https://i.imgbox.com/wFyxXQyf.png" alt="g"></a>&nbsp;</span>
    </td>
    </tr>
    <tr><td colspan="2" height="5"></td></tr>
    
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </div>';
	smtp_mailer($session_email,'C???m ??n v?? ???? mua s???n ph???m',$html);
	
}else{
	echo "<script>window.open('../customer/login.php','self')</script>";
}
?>