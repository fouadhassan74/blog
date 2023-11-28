<?php
require "../admin/partials/header.php";
if(isset($_POST['submit'])){
    $id=filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $title=filter_var($_POST["title"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description=filter_var($_POST["description"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(!$title){
        $_SESSION['edit-category']="Enter the title";
    }else if(!$description){
         $_SESSION['edit-category']="Enter the description";
    }
    if(isset($_SESSION['edit-category'])){
        header('location:'.ROOT_URL.'admin/edit-category.php?id='.$id);
        die();
    }else{
        // update query
        $update_query_category="UPDATE `categories` SET `title`='$title',`description`='$description' WHERE `id`='$id'";
        $update_query_result=mysqli_query($connection,$update_query_category);
        if(mysqli_errno($connection)){
            $_SESSION['edit-category']="There sometiong error";
            header('location:'.ROOT_URL.'admin/edit-category.php?id='.$id);
            die();
        }else{
            $_SESSION['edit-category-success']="Category $title Updated successfully";
            header('location:'.ROOT_URL.'admin/manage-categories.php');
            die();
        }
    }
}else{
    header('location:'.ROOT_URL.'admin/edit-category?id='.$id);
    die();
}
?>