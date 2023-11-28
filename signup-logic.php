<?php
require "./config/database.php";
if(isset($_POST["submit"])){
    $firstname = filter_var($_POST["firstname"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST["lastname"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST["username"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
    $createpassword = filter_var($_POST["createpassword"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST["confirmpassword"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES["avatar"];
    // validate input values
    if(!$firstname){
        $_SESSION["signup"]="Please Enter Your First Name";
        echo"Please Enter Your First Name";
    }else if(!$lastname){
          $_SESSION["signup"]="Please Enter Your Last Name";
          echo"Please Enter Your Last Name";
    }else if(!$email){
          $_SESSION["signup"]="Please A Valid Email";
          echo"Please A Valid Email";
    }else if(strlen($createpassword)<8){
          $_SESSION["signup"]="Please Enter Strong Password More Than 8 Char";
           echo"Please Enter Strong Password More Than 8 Char";
    }else if(!$avatar["name"]){
          $_SESSION["signup"]="Please Enter  a Photo";
          echo"Please Enter  a Photo";
    }else{
        // if a create password do not match a confirm password
        if($createpassword!=$confirmpassword){
                 $_SESSION["signup"]="Password does not match";
                 echo"Password does not match";
        }else{
            $hashpassword=password_hash($createpassword,PASSWORD_DEFAULT);
            // check if username or email exists in database
            $user_check_query="SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result= mysqli_query($connection,$user_check_query);
            if(mysqli_num_rows($user_check_result)>0){
                $_SESSION["signup"]="Email or Username already exists";
            }else{
                //avatar uploading
                $time=time();
                $avatar_name=$time.$avatar["name"];
                $avatar_tmp_name=$avatar["tmp_name"];
                $avatar_destnation_path='images/'.$avatar_name;
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
                }
                else{
                    $_SESSION["signup"]="Allowed files is a jpg,png and jepg ";
                }
            }
        }
    }
    //redirect to sign up page if there is a problem
    if(isset($_SESSION["signup"])){
        //pass form data back up to sign up page if there is a problem
        $_SESSION['signup-data']=$_POST;
        header('location:'.ROOT_URL.'signup.php');
        die();
    }else{
        $insert_user_query="INSERT INTO `users` (`firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`) 
        VALUES ( '$firstname', '$lastname', '$username', '$email', '$hashpassword', '$avatar_name', '0')";
        $insert_user_result=mysqli_query($connection,$insert_user_query);
        if(!mysqli_errno($connection)){
            $_SESSION['signup-success']="Registration successed , Please sign in";
            header('location:'.ROOT_URL.'signin.php');
            die();
        }
    }
}
else{
header('location:'.ROOT_URL."signup.php");
}
?>