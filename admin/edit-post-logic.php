<?php
require "../admin/config/database.php";
if(isset($_POST['submit'])){
    $id=filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT);
    $title=filter_var($_POST["title"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $previous_thumbnail_name=filter_var($_POST["previous_thumbnail_name"]);
    $body=filter_var($_POST["body"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id=filter_var($_POST["category"],FILTER_SANITIZE_NUMBER_INT);
    $author_id=$_SESSION['user-id'];
    $is_featured=filter_var($_POST["is_featured"],FILTER_SANITIZE_NUMBER_INT);
    $thumbnail=$_FILES['thumbnail'];
    //set is featured to 0 if not checked
    $is_featured==1?1:0;
    // validate form data
    if(!$title || !$body || !$category_id || !$author_id){
        $_SESSION['edit-post']="Invalid inputs please enter the inputs please";
    }else{
        if($thumbnail['name']){
            $previous_thumbnail_path='../images/'.$previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }
        }
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
                $_SESSION['edit-post']="the image is bigger than 2mb";
            }
        }else{
            $_SESSION['edit-post']="Allowed files is a png,jepg and jpg";
        }
        echo"<pre>";
        print_r($thumbnail);
        echo "</pre>";
    }
    // redirect back with form data
    if(isset($_SESSION['edit-post'])){
        $_SESSION['edit-post-data']=$_POST;
        header('location:'.ROOT_URL."admin/edit-post.php?id=$id");
        die();
    }else{
        // set all features to if the feature is 1;
        if($is_featured==1){
            $zero_all_is_featured_query="UPDATE `posts` SET is_featured=0";
            $zero_all_is_featured_result=mysqli_query($connection,$zero_all_is_featured_query);
        }
        //which thumbnail insert
        $thumbnail_to_inset=$thumbnail_name??$$previous_thumbnail_name;
        // inset post into database
        $query="UPDATE `posts` SET `title`='$title' , `body`='$body',`thumbnails`='$thumbnail_to_inset',
        `category_id`='$category_id',`is_featured`='$is_featured' WHERE id=$id LIMIT 1";
        $query_result=mysqli_query($connection,$query);
        if(mysqli_errno($connection)){
            $_SESSION['edit-post']="there is something wrong,please try again later";
            header("location:".ROOT_URL."admin/edit-post?id=$id");
            die();
        }else{
            $_SESSION['edit-post-success']="Post edited successfully";
            header("location:".ROOT_URL."admin/");
            die();
        }
    }
}else{
    header('location:'.ROOT_URL.'admin/edit-post');
    die();
}
?>