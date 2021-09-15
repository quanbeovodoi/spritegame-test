
<div class="mainTable">
    <h3 class="section-title">Đơn Hàng</h3>
    <table>
        <!--thead-->
        <thead>
    
            <tr>
                <th colspan="2">Sản Phẩm</th>
                <th>Tiền đến hạn</th>
                <th>Ngày</th>
                <th>Thanh toán</th>
            </tr>
    
        </thead>
        <!--end thead-->
    
        <!--tbody-->
        <tbody>
        <?php

            $session_email = $_SESSION['customer_email'];

            $get_customer = "select * from customers where customer_email='$session_email'";

            $run_customer = mysqli_query($conn, $get_customer);

            $row_customer = mysqli_fetch_array($run_customer);

                $customer_id = $row_customer['customer_id'];

            $get_orders = "select * from customer_orders where customer_id='$customer_id' order by 1 DESC";

            $run_orders = mysqli_query($conn, $get_orders);

            while ($row_orders = mysqli_fetch_array($run_orders)) {

                $order_id = $row_orders['order_id'];

                $due_amount = $row_orders['due_amount'];

                $product_id = $row_orders['product_id'];

                $order_date = $row_orders['order_date'];

                $order_status = $row_orders['order_status'];

                if ($order_status=="Pending") {

                    $order_status = 'Chưa';

                } else {

                    $order_status = 'Đã xong';

                }

                $get_products = "select * from products where product_id='$product_id'";

                $run_products = mysqli_query($conn, $get_products);
                
                while ($row_products = mysqli_fetch_array($run_products)) {

                    $product_title = $row_products['product_title'];

                    $product_image_1 = $row_products['product_image_1'];

        
        ?>
            <tr>
                <td><img class="table__image" src="../admin/<?php echo $product_image_1; ?>" alt=""></td>
                <td><a class="table__title" href="../details.php?product_id=<?php echo $product_id; ?>" target="_blank"><?php echo $product_title; ?></a></td>
                <td><?php echo $due_amount; ?>.000₫</td>
                <td><?php echo $order_date; ?></td>
                <td><?php echo $order_status; ?></td>
                <td>
                <a href="#">
                    <button class="button">Thanh toán</button>
                </a>
                </td>
            </tr>

        <?php } } ?>
        </tbody>

    </table>
    
</div>