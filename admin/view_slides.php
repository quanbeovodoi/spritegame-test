<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                
                    Slide ảnh
                
                </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->
            <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <th>xoá</th>
                            <th>Sửa</th> 
                        </tr>
                    </thead>

                    <tbody>
                <?php 
                
                    $get_slides = "select * from slides";
        
                    $run_slides = mysqli_query($conn, $get_slides);
        
                    while ($row_slides = mysqli_fetch_array($run_slides)) {
                        
                        $slide_id = $row_slides['slide_id'];
                        
                        $slide_title = $row_slides['slide_title'];

                        $slide_description = $row_slides['slide_description'];
                        
                        $slide_image = $row_slides['slide_image'];

                        $slide_url = $row_slides['slide_url'];
                
                ?>

                
                        <tr>
                            <td><?php echo $slide_title; ?></td>
                            <td><?php echo $slide_description; ?></td>
                            <td width="40%" height="40%"><img src="<?php echo $slide_image; ?>" alt="<?php echo $slide_title; ?>" class="img-fluid"></td>
                            <td>
                                <a href="index.php?delete_slide=<?php echo $slide_id; ?>" class="pull-right"><!-- pull-right begin -->
                                    <button type="button" class="btn btn-block btn-outline-danger btn-sm">Xóa</button>
                                </a>
                            </td>
                            <td>
                                <a href="index.php?edit_slide=<?php echo $slide_id; ?>" class="pull-left"><!-- pull-left begin -->
                                    <button type="button" class="btn btn-block btn-outline-info btn-sm">Sửa</button>
                                </a>
                            </td>
                        </tr>
                <?php } ?>    
                    </tbody>
                </table>   
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->


<?php } ?>