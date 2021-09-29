<?php
// connecting to database
$conn = mysqli_connect("sql6.freemysqlhosting.net", "sql6441134", "kEdKPvNGTY", "sql6441134") or die("Database Error");
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);
$insert_product = "INSERT INTO `comments` ( `product_id`, `id_cus`, `comment`) VALUES ('2', '2', '$getMesg');";
$run_query = mysqli_query($conn, $insert_product) or die("Error");
if($run_query){
    echo $getMesg;
}
//checking user query to database query
// $check_data = "SELECT comment FROM comments";
// $run_query = mysqli_query($conn, $check_data) or die("Error");
// if(mysqli_num_rows($run_query) > 0){
//     $fetch_data = mysqli_fetch_assoc($run_query);
//     $replay = $fetch_data['comment'];
//     echo $replay;
// }
?>