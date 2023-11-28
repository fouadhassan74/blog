<?php
require "../admin/partials/header.php";
if(isset($_POST["submit"])){
    //get form data 
    $title=filter_var($_POST["title"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description=filter_var($_POST["description"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(!$title){
        $_SESSION["add-category"]="Enter the title of category";
    }
    else if(!$description){
        $_SESSION["add-category"]="Enter the description of category";
    }
    //redirect back to 
    if(isset($_SESSION["add-category"])){
        $_SESSION["add-category-data"]=$_POST;
        header('location: '.ROOT_URL.'/admin/add-category.php');
        die();
    }else{
        // insert category into database
        $inset_category_query="INSERT INTO `categories`(`title`,`description`) VALUES ('$title','$description')";
        $result=mysqli_query($connection,$inset_category_query);
        if(mysqli_errno($connection)){
            $_SESSION["add-category"]="could not add category";
            header('location:'.ROOT_URL.'admin/add-category');
            die();
        }else{
            $_SESSION["add-category-success"]="Category $title added successfully";
            header('location:'.ROOT_URL.'admin/manage-categories.php');
            die();
        }
    }
    
}
?>