<?php

    if (!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    } else {

?>    
    <div class="row">
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Sản phẩm</span>
                  <span class="info-box-number"><?php echo $count_products; ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Đơn đặt hàng</span>
                <span class="info-box-number"><?php echo $count_customer_orders; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Members</span>
                <span class="info-box-number"><?php echo $count_customers; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Đơn hàng mới</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>ID Đặt Hàng</th>
                        <th>Địa Chỉ Email</th>
                        <th>ID Sản Phẩm</th>
                        <th>Trạng Thái</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                            
                            $i=0;

                            $get_order = "select * from customer_orders order by 1 DESC LIMIT 0,5";

                            $run_order = mysqli_query($conn, $get_order);

                            while ($row_order = mysqli_fetch_array($run_order)){

                                $order_id = $row_order['order_id'];

                                $customer_id = $row_order['customer_id'];

                                $product_id  = $row_order['product_id'];

                                $order_status = $row_order['order_status'];

                                $i++;

                        ?>
                       
                        <tr>
                            <td><?php echo $order_id; ?></td>
                            <td> 
                            
                                <?php
                                
                                    $get_customer = "select * from customers where customer_id='$customer_id'";

                                    $run_customer = mysqli_query($conn, $get_customer);

                                    $row_customer = mysqli_fetch_array($run_customer);

                                    $customer_email = $row_customer['customer_email'];

                                    echo $customer_email;
                                
                                ?>
                            
                            </td>
                            <td><?php echo $product_id; ?></td>
                            <td> 
                                <?php 

                                  if ($order_status=="0") {

                                    $order_status = 'Chưa';

                                  }else if ($order_status=="1") {

                                    $order_status = 'Không thành công';

                                  }else{
                                    $order_status = 'Đã thanh toán';
                                  }
                                  echo $order_status;
                                ?> 
                            </td>
                            
                        </tr>
                                
                        <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
    <?php } ?>