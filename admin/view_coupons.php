<?php 
    
    if (!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {


?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h3 class="panel-title">
               
                    Mã giảm giá
                
                </h3>
            </div>
            
            <div class="panel-body">
                <div class="table-responsive">
                    <!--table-->
                    <table class="table table-striped table-bordered table-hover">
                        
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Mã Giảm Giá</th>
                                <th>Giới Hạn</th>
                                <th>Đã Dùng</th>
                                <th>Sửa</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                                $i=0;

                                $get_coupons = "select * from coupons";

                                $run_coupons = mysqli_query($conn, $get_coupons);

                                while ($row_coupons = mysqli_fetch_array($run_coupons)) {

                                    $coupon_id = $row_coupons['coupon_id'];

                                    $coupon_product_id = $row_coupons['product_id'];

                                    $coupon_title = $row_coupons['coupon_title'];

                                    $coupon_price = $row_coupons['coupon_price'];

                                    $coupon_code = $row_coupons['coupon_code'];

                                    $coupon_limit = $row_coupons['coupon_limit'];

                                    $coupon_used = $row_coupons['coupon_used'];
                                    

                                    $get_products = "select * from products where product_id='$coupon_product_id'";

                                    $run_products = mysqli_query($conn, $get_products);

                                    $row_products = mysqli_fetch_array($run_products);

                                        $product_title = $row_products['product_title'];

                                    $i++;
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $coupon_title; ?></td>
                                <td><?php echo $product_title; ?></td>
                                <td><?php echo $coupon_price; ?></td>
                                <td><?php echo $coupon_code; ?></td>
                                <td><?php echo $coupon_limit; ?></td>
                                <td><?php echo $coupon_used; ?></td>
                                <td>
                                    
                                    <a href="index.php?edit_coupon=<?php echo $coupon_id; ?>">
                                    <button type="button" class="btn btn-block btn-outline-info btn-sm">Sửa</button>
                                    </a>

                                </td>
                                <td>
                                    <a href="index.php?delete_coupon=<?php echo $coupon_id; ?>">
                                    <button type="button" class="btn btn-block btn-outline-danger btn-sm">Xoá</button>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                        <?php } ?>
                    </table>
                    <!--end table-->
                </div>

            </div>
            
        </div>
    </div>
</div>

<?php } ?>