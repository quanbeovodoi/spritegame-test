<?php
    session_set_cookie_params('86400');
    session_start();

?>
<?php
require_once "../includes/db.php";
require_once "../functions/functions.php";
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id

$session_email = $_SESSION['customer_email'];
$get_customer = "select * from customers where customer_email='$session_email'";
$run_customer = mysqli_query($conn, $get_customer);
$row_customer = mysqli_fetch_array($run_customer);
$customer_id = $row_customer['customer_id'];
$userId = $customer_id; 
$product_id = $_GET['product_id'];
$get_product = "select * from products where product_id = '$product_id'";
$run_product = mysqli_query($conn, $get_product);
$row_product = mysqli_fetch_array($run_product);
$outputString = '';

$userRating = userRating($userId, $row_product['product_id'], $conn);
$totalRating = totalRating($row_product['product_id'], $conn);
$outputString .= '
<div class="row-item">
<div class="row-title">' . $row_product['product_title'] . '</div> <div class="response" id="response-' . $row_product['product_id'] . '"></div>
<ul class="list-inline"  onMouseLeave="mouseOutRating(' . $row_product['product_id'] . ',' . $userRating . ');"> ';
    for ($count = 1; $count <= 5; $count ++) {
        $starRatingId = $row_product['product_id'] . '_' . $count;
                                        
        if ($count <= $userRating) {
                                            
            $outputString .= '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected"  onclick="addRating(' . $row_product['product_id'] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $row_product['product_id'] . ',' . $count . ');">&#9733;</li>';
        } else {
            $outputString .= '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $row_product['product_id'] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $row_product['product_id'] . ',' . $count . ');">&#9733;</li>';
        }
    }
$outputString .= '
    </ul>
                                    
    <p class="review-note">Số Người đã đánh giá: ' . $totalRating . '</p>
    <p class="text-address"><b style="color: #609c9c;">Lần cập nhật cuối cùng: </b>' . $row_product["date"] . '</p>
    </div>
    ';
echo $outputString;
?>