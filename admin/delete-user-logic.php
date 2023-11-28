<?php
require "../admin/config/database.php";
if(isset($_GET["id"])){
    $id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
    //fetch user from database
    $fetch_query="SELECT * FROM `users` WHERE id=$id";
    $fetch_query_result=mysqli_query($connection,$fetch_query);
    $user=mysqli_fetch_assoc($fetch_query_result);
    if(mysqli_num_rows($fetch_query_result)==1){
        $avatar_name=$user["avatar"];
        $avatar_path="../images/".$avatar_name;
        // delete image if it available
        if($avatar_path){
            unlink($avatar_path);
        }
    }
    // for later delet posts and thumbnails 
    $get_user_posts_thumnails="SELECT thumbnails FROM `posts` WHERE author_id=$id";
    $fetch_thumbnails=mysqli_query($connection,$get_user_posts_thumnails);
    if(mysqli_errno($connection)){
         $_SESSION["delete-user"]="there something wrong please try later";
        header("Location:".ROOT_URL."admin/manage-users.php");
        die();
    }
    if(mysqli_num_rows($fetch_thumbnails)>0){
        while($thumbnail=mysqli_fetch_assoc($fetch_thumbnails)){
            $thumbnail_path='../images/'.$thumbnail['thumbnails'];
            unlink($thumbnail_path);
        }
    }
    // delete user from database
    $delete_user_query="DELETE FROM `users` WHERE id=$id";
    $delete_user_result=mysqli_query($connection,$delete_user_query);
    if(mysqli_errno($connection)){
        $_SESSION["delete-user"]="there something wrong please try later";
        header("Location:".ROOT_URL."admin/manage-users.php");
        die();
    }else{
        $_SESSION["delete-user-success"]="User Deleted Successfully";
        header("Location:".ROOT_URL."admin/manage-users.php");
        die();
    }
}else{
    header("Location:".ROOT_URL."admin/manage-users.php");
    die();
}
?>