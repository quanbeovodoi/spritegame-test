<?php
    session_set_cookie_params('86400');
    session_start();
    include("includes/db.php");
    include("functions/functions.php");
    if(isset($_SESSION['customer_email'])){
        $session_email = $_SESSION['customer_email'];
        $get_customer = "select * from customers where customer_email='$session_email'";
        $run_customer = mysqli_query($conn, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);
        $cus_id = $row_customer['customer_id'];
        $getMesg = mysqli_real_escape_string($conn, $_POST['text']);
        $getPrdId = mysqli_real_escape_string($conn, $_POST['product_id']);
        $insert_product = "INSERT INTO `comments` ( `product_id`, `id_cus`, `comment`) VALUES ('$getPrdId', '$cus_id', '$getMesg');";
        $run_query = mysqli_query($conn, $insert_product) or die("Error");
        $comment_id = mysqli_insert_id($conn);
        // echo "New record created successfully. Last inserted ID is: " . $comment_id;

        //like_insert
         //$run_comment = mysqli_query($conn, $get_comment);
        // $insert_likecomment_1 = "INSERT INTO likecomments(id_comments,type_like,number_like) VALUES ('$comment_id','0','0');";
        // $insert_likecomment_2 = "INSERT INTO likecomments(id_comments,type_like,number_like) VALUES ('$comment_id','1','0');";
        // $insert_likecomment_3 = "INSERT INTO likecomments(id_comments,type_like,number_like) VALUES ('$comment_id','2','0');";
        // $run_insert_likecomment_1 = mysqli_query($conn, $insert_likecomment_1) or die("Error");
        // $run_insert_likecomment_2 = mysqli_query($conn, $insert_likecomment_2) or die("Error");
        // $run_insert_likecomment_3 = mysqli_query($conn, $insert_likecomment_3) or die("Error");
        if($run_query){
            echo $comment_id.','.$getMesg;
        }
    }else{
        echo "Hãy đăng nhập để bình luận! ";
    }
// connecting to database

//checking user query to database query
// $check_data = "SELECT comment FROM comments";
// $run_query = mysqli_query($conn, $check_data) or die("Error");
// if(mysqli_num_rows($run_query) > 0){
//     $fetch_data = mysqli_fetch_assoc($run_query);
//     $replay = $fetch_data['comment'];
//     echo $replay;
// }
?>