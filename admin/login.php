<?php

    session_start();
    include("../includes/db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<section class="login-page">
  	 <form action="" method="post">
  	 	 <div class="box">
  	 	 	   <div class="form-head">
  	 	 	   	  <h2>ADMIN</h2>
  	 	 	   </div>
  	 	 	   <div class="form-body">
  	 	 	   	  <input type="text" name="admin_email" placeholder="Enter name" />
  	 	 	   	  <input type="Password" name="admin_pass" placeholder="Password" />
  	 	 	   </div>
  	 	 	   <div class="form-footer">
  	 	 	   	  <button name="admin_login">Sign In</button>
  	 	 	   </div>
  	 	 </div>
  	 </form>
</section>
    <script src="js/main.js"></script>
</body>
</html>

<?php

    if (isset($_POST['admin_login'])) {

        $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);

        $admin_pass = mysqli_real_escape_string($conn, $_POST['admin_pass']);

        $get_admin = "select * from admins where admin_email='$admin_email' AND admin_password='$admin_pass'";

        $run_admin = mysqli_query($conn, $get_admin);

        $count = mysqli_num_rows($run_admin);
        //echo"<script> console.log('$admin_email') </script>";

        if ($count==1) {

            $_SESSION['admin_email']=$admin_email;

            echo "<script>window.open('index.php?dashboard','_self')</script>";

        } else {

            echo "<script>alert('Email hoặc Mật Khẩu Chưa Đúng')</script>";

        }

    }

?>
