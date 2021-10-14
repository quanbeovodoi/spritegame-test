<?php
    session_set_cookie_params('86400');
    session_start();

?>
<?php
require_once ('../includes/db.php');
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id

$session_email = $_SESSION['customer_email'];
$get_customer = "select * from customers where customer_email='$session_email'";
$run_customer = mysqli_query($conn, $get_customer);
$row_customer = mysqli_fetch_array($run_customer);
$customer_id = $row_customer['customer_id'];
$userId = $customer_id;


if (isset($_POST["index"], $_POST["product_id"])) {
    
    $productId = $_POST["product_id"];
    $rating = $_POST["index"];
    
    $checkIfExistQuery = "select * from ratestart where id_cus = '" . $userId . "' and product_id = '" . $productId . "'";
    if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    if ($rowcount == 0) {
        $insertQuery = "INSERT INTO ratestart(id_cus,product_id, ratingnumber) VALUES ('" . $userId . "','" . $productId . "','" . $rating . "') ";
        $result = mysqli_query($conn, $insertQuery);
        //rate sum
        $avgQuery="SELECT AVG(ratingnumber) AS rateRow FROM ratestart WHERE product_id = '" . $productId . "'";
        $avg=mysqli_query($conn, $avgQuery);
        $ratingsum = $avg;
        $math_rate = mysqli_fetch_assoc($ratingsum);
        $numberrate = (int)$math_rate['rateRow'];
        $updatedRatePro = "UPDATE products SET Rate ='" . (int)$numberrate . "' WHERE product_id = '" . $productId . "'";
        mysqli_query($conn, $updatedRatePro);
        echo "success";
    } else {
        $insertQuery = "UPDATE ratestart SET ratingnumber='".$rating."'WHERE product_id = '" . $productId . "'AND id_cus = '" . $userId . "'" ;
        $result = mysqli_query($conn, $insertQuery);
        //rate sum
        $avgQuery="SELECT AVG(ratingnumber) AS rateRow FROM ratestart WHERE product_id = '" . $productId . "'";
        $avg=mysqli_query($conn, $avgQuery);
        $ratingsum = $avg;
        $math_rate = mysqli_fetch_assoc($ratingsum);
        $numberrate = (int)$math_rate['rateRow'];
        $updatedRatePro = "UPDATE products SET Rate ='" . (int)$numberrate . "' WHERE product_id = '" . $productId . "'";
        mysqli_query($conn, $updatedRatePro);
        echo "Cập nhật";
    }
}
