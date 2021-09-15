<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

        
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
               
                  Tất cả đơn hàng
                
                </h3>
            </div>
            
            <div class="panel-body">
                <div class="table-responsive">
                    <!--table-->
                    <table class="table table-striped table-bordered table-hover">
                        
                        <thead>
                            <tr>
                                <th> STT </th>
                                <th> Địa Chỉ Email </th>
                                <th> Tên Sản phẩm </th>
                                <th> Ngày </th>
                                <th> Tổng </th>
                                <th> Trạng Thái </th>
                                <th> Xoá </th>
                                <th>Xác nhận thanh toán</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php 
          
                                $i=0;
                            
                                $get_orders = "select * from customer_orders";
                                
                                $run_orders = mysqli_query($conn, $get_orders);
          
                                while ($row_order=mysqli_fetch_array($run_orders)){
                                    
                                    $order_id = $row_order['order_id'];
                                    
                                    $customer_id = $row_order['customer_id'];
                                    
                                    $order_amount = $row_order['due_amount'];
                                    
                                    $product_id = $row_order['product_id'];
                                    
                                    $order_date = $row_order['order_date'];
                                    
                                    $order_status = $row_order['order_status'];
                                    
                                    $get_products = "select * from products where product_id='$product_id'";
                                    
                                    $run_products = mysqli_query($conn, $get_products);
                                    
                                    $row_products = mysqli_fetch_array($run_products);
                                    
                                        $product_title = $row_products['product_title'];
                                    
                                    $get_customer = "select * from customers where customer_id='$customer_id'";
                                    
                                    $run_customer = mysqli_query($conn, $get_customer);
                                    
                                    $row_customer = mysqli_fetch_array($run_customer);
                                    
                                        $customer_email = $row_customer['customer_email'];
                                    
                                    $i++;
                            
                            ?>
                            
                            <tr>

                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $customer_email; ?> </td>
                                <td> <?php echo $product_title; ?> </td>
                                <td> <?php echo $order_date; ?> </td>
                                <td> <?php echo $order_amount; ?>.000₫</td>
                                <td>
                                    
                                    <?php 
                                    
                                        if($order_status=='Pending') {
                                            
                                            echo $order_status='Đang Chờ Xử Lý';
                                            
                                        } else {
                                            
                                            echo $order_status='Đã xác nhận';
                                            
                                        }
                                    
                                    ?>
                                    
                                </td>
                                <td> 
                                     
                                    <a href="index.php?delete_order=<?php echo $order_id; ?>">
                                     
                                    <button type="button" class="btn btn-block btn-outline-danger btn-sm">Xoá</button>
                                    
                                    </a> 
                                     
                                </td>
                                <td>
                                <a href="index.php?confirm_yes=<?php echo $order_id; ?>" class="btn btn-block btn-success btn-sm"> Xác nhận</a>
                                <a href="index.php?confirm_no=<?php echo $order_id; ?>" class="btn btn-block btn-dark btn-sm"> Huỷ </a>
                                </td>

                            </tr>
                            
                            <?php } ?>
                            
                        </tbody>
                        
                    </table>
                    <!--end table-->
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>