<?php
require "../admin/config/database.php";
if(isset($_GET["id"])){
    $id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
    $get_post_query="SELECT * FROM `posts` WHERE id=$id";
    $fetch_result=mysqli_query($connection,$get_post_query);
    if(mysqli_num_rows($fetch_result)==1){
        $post=mysqli_fetch_assoc($fetch_result);
        $get_post_thumbnail=$post['thumbnails'];
        $get_thumbnail_path="../images/".$get_post_thumbnail;
        if($get_thumbnail_path){
            unlink($get_thumbnail_path);
            $delete_query="DELETE FROM `posts` WHERE id=$id";
            $delete_result=mysqli_query($connection,$delete_query);
            if(mysqli_errno($connection)){
                $_SESSION['delete-post']="there something error please try again later";
                header('location:'.ROOT_URL.'admin/');
                die();
            }else{
                $_SESSION['delete-post-success']="post  has been deleted";
                header('location:'.ROOT_URL.'admin/');
                die();
            }
        }
    }
}else{
    header('location:'.ROOT_URL.'admin/');
}
?>