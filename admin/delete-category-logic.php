<?php
require "../admin/partials/header.php";
if(isset($_GET['id'])){
    $id=filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $delete_category_query="DELETE  FROM `categories` WHERE id=$id";
    $update_query="UPDATE `posts` SET `category_id`=8 WHERE `category_id`=$id";
    $fetch_query=mysqli_query($connection, $update_query);
    $delete_category_result = mysqli_query($connection, $delete_category_query);
    // set posts uncategorised
   
   
    if(mysqli_errno($connection)){
        $_SESSION["delete-category"]="there something wrong please try later";
        header("Location:".ROOT_URL."admin/manage-categories.php");
        die();
    }else{
        $_SESSION["delete-category-success"]="Category deleted successfully";
        header("Location:".ROOT_URL."admin/manage-categories.php");
        die();
    }
}else{
    header('location:'.ROOT_URL.'admin/manage-categories');
    die();
}
?>