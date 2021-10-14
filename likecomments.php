<?php
    session_set_cookie_params('86400');
    session_start();
    include("includes/db.php");
    include("functions/functions.php");
    if(isset($_SESSION['customer_email'])&&isset($_POST['comment_id'])&&isset($_POST['text'])){
        $session_email = $_SESSION['customer_email'];
        $type_like = $_POST['text'];
        $get_customer = "select * from customers where customer_email='$session_email'";
        $run_customer = mysqli_query($conn, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);
        $cus_id = $row_customer['customer_id'];
        $comment_id=$_POST['comment_id'];
        //find_like_comments
        $get_likecomment = "SELECT * FROM likecomments WHERE id_comments = '$comment_id' AND id_cus='$cus_id'";
        $run_get_likecomment = mysqli_query($conn, $get_likecomment) or die("Error");
        $number_get_likecomment = mysqli_num_rows($run_get_likecomment);
        

        if($number_get_likecomment==0){

            $insert_likecomment = "INSERT INTO likecomments(id_comments,id_cus,type_like,number_like) VALUES ('$comment_id','$cus_id','$type_like','1');";
            $run_insert_likecomment = mysqli_query($conn, $insert_likecomment) or die("Error");
            //count-comment
            $count_likecomment = "SELECT type_like,SUM(number_like) AS Numberlike FROM likecomments WHERE id_comments='$comment_id' GROUP BY type_like";
            $run_count_likecomment = mysqli_query($conn, $count_likecomment);
            $array = array(0,0,0);
            while($row_count_likecomment = mysqli_fetch_array($run_count_likecomment)){
                if($row_count_likecomment['Numberlike']==''&&$row_count_likecomment['Numberlike']==NULL)
                {
                    echo 0;
                }else{
                    $array[$row_count_likecomment['type_like']]=(int)$row_count_likecomment['Numberlike'];
                }
            };
            $str = json_encode($array);
            $str = str_replace( array('[', ']') , '', $str );
            echo $str;
            // end coun comment
        }else{
            $row_get_likecomment = mysqli_fetch_array($run_get_likecomment);
            if($row_get_likecomment['type_like']!=$type_like){
                $update_likecomment="UPDATE likecomments SET type_like = '$type_like' WHERE id_comments = '$comment_id' AND id_cus='$cus_id' ";
                $run_update_likecomment = mysqli_query($conn, $update_likecomment) or die("Error");
                //count-comment
                $count_likecomment = "SELECT type_like,SUM(number_like) AS Numberlike FROM likecomments WHERE id_comments='$comment_id' GROUP BY type_like";
                $run_count_likecomment = mysqli_query($conn, $count_likecomment);
                $array = array(0,0,0);
                while($row_count_likecomment = mysqli_fetch_array($run_count_likecomment)){
                    if($row_count_likecomment['Numberlike']==''&&$row_count_likecomment['Numberlike']==NULL)
                    {
                        echo 0;
                    }else{
                        $array[$row_count_likecomment['type_like']]=(int)$row_count_likecomment['Numberlike'];
                    }
                };
                $str = json_encode($array);
                $str = str_replace( array('[', ']') , '', $str );
                echo $str;
                // end coun comment
            }else{
                $delete_likecomment="DELETE FROM likecomments WHERE id_comments = '$comment_id' AND type_like = '$type_like' AND  id_cus='$cus_id' ";
                $run_delete_likecomment = mysqli_query($conn, $delete_likecomment) or die("Error");
                //count-comment
                $count_likecomment = "SELECT type_like,SUM(number_like) AS Numberlike FROM likecomments WHERE id_comments='$comment_id' GROUP BY type_like";
                $run_count_likecomment = mysqli_query($conn, $count_likecomment);
                $array = array(0,0,0);
                while($row_count_likecomment = mysqli_fetch_array($run_count_likecomment)){
                    if($row_count_likecomment['Numberlike']==''&&$row_count_likecomment['Numberlike']==NULL)
                    {
                        echo 0;
                    }else{
                        $array[$row_count_likecomment['type_like']]=(int)$row_count_likecomment['Numberlike'];
                    }
                };   

                $str = json_encode($array);
                $str = str_replace( array('[', ']') , '', $str );
                echo $str;
                // end coun comment
            }
        }
        //insert
        
    }
?>