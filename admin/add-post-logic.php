<?php
require "../admin/config/database.php";
if(isset($_POST['submit'])){
    $title=filter_var($_POST["title"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body=filter_var($_POST["body"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id=filter_var($_POST["category"],FILTER_SANITIZE_NUMBER_INT);
    $author_id=$_SESSION['user-id'];
    $is_featured=filter_var($_POST["is_featured"],FILTER_SANITIZE_NUMBER_INT);
    $thumbnail=$_FILES['thumbnail'];
    //set is featured to 0 if not checked
    $is_featured==1?1:0;
    // validate form data
    if(!$title){
        $_SESSION['add-post']="Please enter the title of post";
    }else if(!$body){
        $_SESSION['add-post']="Please enter the body of post";
    }else if(!$category_id){
        $_SESSION['add-post']="Please enter the category of post";
    }else if(!$thumbnail['name']){
        $_SESSION['add-post']="Please enter the thumbnail of post";
    }else{
        //Work On thumbnail
        $time =time();
        $thumbnail_name=$time.$thumbnail['name'];
        $thumbnail_tmp_name=$thumbnail['tmp_name'];
        $thumbnail_destnation_path='../images/'.$thumbnail_name;
        $allowed_files=['png','jpg','jepg'];
        $slicing=explode(".",$thumbnail_name);
        $extenetion=end($slicing);
        // checking up that is an image
        if(in_array($extenetion, $allowed_files)){
            //checking size of image
            if($thumbnail['size']<3_000_000){
                move_uploaded_file($thumbnail_tmp_name,$thumbnail_destnation_path);
            }else{
                $_SESSION['add-post']="the image is bigger than 2mb";
            }
        }else{
            $_SESSION['add-post']="Allowed files is a png,jepg and jpg";
        }
        echo"<pre>";
        print_r($thumbnail);
        echo "</pre>";
    }
    // redirect back with form data
    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data']=$_POST;
        header('location:'.ROOT_URL.'admin/add-post.php');
        die();
    }else{
        // set all features to if the feature is 1;
        if($is_featured==1){
            $zero_all_is_featured_query="UPDATE `posts` SET is_featured=0";
            $zero_all_is_featured_result=mysqli_query($connection,$zero_all_is_featured_query);
        }
        // inset post into database
        $query="INSERT INTO `posts` (`title`,`body`,`thumbnails`,`category_id`,`author_id`,`is_featured`) 
        VALUES ('$title','$body','$thumbnail_name','$category_id','$author_id','$is_featured')";
        $query_result=mysqli_query($connection,$query);
        if(mysqli_errno($connection)){
            $_SESSION['add-post']="there is something wrong,please try again later";
            header("location:".ROOT_URL."admin/add-post");
            die();
        }else{
            $_SESSION['add-post-success']="Post added successfully";
            header("location:".ROOT_URL."admin/");
            die();
        }
    }
}else{
    header('location:'.ROOT_URL.'admin/add-post');
    die();
}
?>