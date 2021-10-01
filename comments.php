<?php
session_set_cookie_params('86400');
session_start();
if(isset($_SESSION['customer_email'])){
    $conn = mysqli_connect("sql6.freemysqlhosting.net", "sql6441134", "kEdKPvNGTY", "sql6441134") or die("Database Error");
    mysqli_set_charset($conn, 'UTF8');
    $getMesg = mysqli_real_escape_string($conn, $_POST['text']);
    $getPrdId = mysqli_real_escape_string($conn, $_POST['product_id']);
    $insert_product = "INSERT INTO `comments` ( `product_id`, `id_cus`, `comment`) VALUES ('$getPrdId', '2', '$getMesg');";
    $run_query = mysqli_query($conn, $insert_product) or die("Error");
    if($run_query){
        echo $getMesg;
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