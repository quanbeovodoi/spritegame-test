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
               
                     Tất cả sản phẩm
                
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
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Đã bán</th>
                                <th>Từ khóa</th>
                                <th>Thời gian</th>
                                <th>Rate</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php

                                $i=0;
                            
                                $get_products = "select * from products order by 1 DESC";
                                
                                $run_products = mysqli_query($conn, $get_products);

                                while ($row_products = mysqli_fetch_array($run_products)){

                                    $product_id = $row_products['product_id'];

                                    $product_title = $row_products['product_title'];

                                    $product_image_1 = $row_products['product_image_1'];

                                    $product_price = $row_products['product_price'];

                                    $product_keywords = $row_products['product_keywords'];

                                    $product_date = $row_products['date'];

                                    $product_label = $row_products['product_label'];

                                    $product_sale = $row_products['product_sale'];

                                    $product_rated = $row_products['Rate'];

                                    $i++;

                            ?>

                            <tr>

                                <td><?php echo $i;?></td>
                                <td><?php echo $product_title; ?></td>
                                <td><img src="<?php echo $product_image_1; ?>" width="60px" alt="<?php echo $product_image_1; ?>"></td>
                                <td>
                                    <?php

                                        if ($product_label == "sale") {

                                            echo $product_sale;

                                        } else {

                                            echo $product_price;
                                        }
                                    
                                    ?>
                                
                                ₫</td>
                                <td> 
                                
                                <?php 
                                
                                    $get_sold = "select * from customer_orders where product_id='$product_id'";

                                    $run_sold = mysqli_query($conn, $get_sold);

                                    $count = mysqli_num_rows($run_sold);

                                    echo $count;
                                
                                ?> 
                                
                                </td>
                                <td><?php echo $product_keywords; ?></td>
                                <td><?php echo $product_date; ?></td>
                                <td><?php echo $product_rated; ?></td>
                                <td> 

                                    <a href="index.php?delete_product=<?php echo $product_id; ?>">
                            
                                    <button type="button" class="btn btn-block btn-outline-danger btn-sm">Xóa</button>
                                    </a> 

                                </td>
                                <td> 

                                    <a href="index.php?edit_product=<?php echo $product_id; ?>">
                            
                                    <button type="button" class="btn btn-block btn-outline-info btn-sm">Sửa</button>

                                    </a> 

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