<?php
require "../admin/config/database.php";
if(isset($_POST["submit"])){
    $firstname=filter_var($_POST["firstname"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname=filter_var($_POST["lastname"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username=filter_var($_POST["username"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
    $password=filter_var($_POST["password"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmedpassword=filter_var($_POST["confirmedpassword"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userrole=filter_var($_POST["userrole"],FILTER_SANITIZE_NUMBER_INT);
    $avatar=$_FILES["avatar"];
    if(!$firstname){
        $_SESSION["add-user"]="Please Enter Your First Name";
        echo"Please Enter Your First Name";
    }elseif(!$lastname){
        $_SESSION["add-user"]="Please Enter Your Last Name";
         echo"Please Enter Your Last Name";
    }elseif(!$username){
        $_SESSION["add-user"]="Please Enter Your Username";
        echo"Please A Valid Email";
    }elseif(!$email){
        $_SESSION["add-user"]="Please Enter Your Email";
        echo"Please Enter Your Email";
    }elseif(strlen($password)<8){
        $_SESSION["add-user"]="Please Enter Strong Password More Than 8 Char";
        echo"Please Enter Strong Password More Than 8 Char";
    }elseif(!$avatar){
        $_SESSION["add-user"]="Please Choose Your Photo";
        echo"Please Choose Your Photo";
    }else{
        //check the password and created password
        if($password!=$confirmedpassword){
            $_SESSION["add-user"]="Password does not match";
            echo"Password does not match";
        }else{
            // password hashing
            $hashpassword=password_hash($password,PASSWORD_DEFAULT);
            //Check if there is user in database
            $user_check_query="SELECT * FROM `users` WHERE username='$username' OR email='$email'";
            $user_check_result=mysqli_query($connection,$user_check_query);
            if(mysqli_num_rows($user_check_result)>0){
                $_SESSION["add-user"]="Email or Username already exists";
            }else{
                //avatar uploading
                // $time=time();
                // $avatar_name=$time.$avatar["name"];
                // $avatar_tmp_name=$avatar["tmp_name"];
                // $avatar_destnation_path='images/'.$avatar_name;
                // //make sure the files is an images
                // $allowed_files=["jpg","png","jepg"];
                // $slicing=explode($avatar_name,".");
                // $extention=end($slicing);
                // if(in_array($extention,$allowed_files)){
                //     //uploading the image
                //     if($avatar["size"]<2000000){
                //         move_uploaded_file($avatar_tmp_name,$avatar_destnation_path);
                //     }else{
                //         $_SESSION["add-user"]="Allowed files is smaller than 2mb ";
                //     }
                  //avatar uploading
                $time=time();
                $avatar_name=$time.$avatar["name"];
                $avatar_tmp_name=$avatar["tmp_name"];
                $avatar_destnation_path='../images/'.$avatar_name;
                //make sure the files is an images
                $allowed_files=["png","jpg","jepg"];
                $sliceing=explode(".",$avatar_name);
                $extention=end($sliceing);
                if(in_array($extention,$allowed_files)){
                    //make sure size is smaller than 2mb
                    if($avatar['size']<20000000){
                        //upload
                        move_uploaded_file($avatar_tmp_name,$avatar_destnation_path);
                    }else{
                        $_SESSION["signup"]="Allowed files is smaller than 2mb ";
                    }
                }else{
                    $_SESSION["add-user"]="Allowed files is a jpg,png and jepg ";
                }
            }
        }
    }
    //redirect to sign up page if there is a problem
    if(isset($_SESSION["add-user"])){
        //pass form data back up to sign up page if there is a problem
        $_SESSION["add-user-data"]=$_POST;
        header("Location:".ROOT_URL."/admin/add-user.php");
        die();
    }else{
     // $insert_user_query="INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`,`lastname`,`password`,`avatar`,`is_admin`) VALUES ('$time', '$firstname', '$lastname', '$username', '$email', '$hashpassword', '$avatar_name', '$userrole')";
        $insert_user_query="INSERT INTO `users` ( `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`)
         VALUES ( '$firstname', '$lastname', '$username', '$email', '$hashpassword', '$avatar_name', '$userrole')";
        $insert_user_result=mysqli_query($connection,$insert_user_query);
        if(!mysqli_errno($connection)){
            $_SESSION['add-user-success']="User Added Successfully";
            header('location:'.ROOT_URL.'/admin/manage-users.php');
            die();
        }
    }
}else{
    header("Location:".ROOT_URL."/admin/add-user.php");
    die();
}
?>