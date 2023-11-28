<?php
require "./config/database.php";
if(isset($_POST["submit"])){
    $username_email=filter_var($_POST["email-username"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password=filter_var($_POST["password"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(!$username_email){
        $_SESSION["signin"]="Please Enter Email Or Username";  
        echo "Please Enter Email Or Username ";
    }else if(!$password){
        $_SESSION["signin"]="Please Enter Password";
        echo "Please Enter Password";
    }else{
        //fetch user from data base
        $fetch_user_query="SELECT * FROM `users` WHERE email='$username_email' OR username='$username_email'";
        $fetch_user_result=mysqli_query($connection,$fetch_user_query);
        if(mysqli_num_rows($fetch_user_result)==1){
            //convert a record into assc array
            $user_record=mysqli_fetch_assoc($fetch_user_result);
            $db_password=$user_record["password"];
            // compare password with dbpassword
            if(password_verify($password,$db_password)){
                //set session for access control
                $_SESSION["user-id"]=$user_record["id"];
                //set session if user a=is an admin
                if($user_record["is_admin"]==1){
                    $_SESSION["user_is_admin"]=true;
                }
                // log user in
                header("Location:".ROOT_URL."admin/");
            
            }else{
                $_SESSION["signin"]="Username Or Password Not Correct";
            }
        }else{
            $_SESSION["signin"]="User Not Found";
        }
    }
    //if there is any problem login
    if(isset($_SESSION["signin"])){
        $_SESSION["signin-data"]=$_POST;
        header("Location:".ROOT_URL."signin.php");
    }
}else{
header("location:".ROOT_URL."signin.php");
die();
}
?>