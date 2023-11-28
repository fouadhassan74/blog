<?php
require "../admin/config/database.php";
if(isset($_POST["submit"])){
    $id=filter_var($_POST["id"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname=filter_var($_POST["firstname"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname=filter_var($_POST["lastname"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username=filter_var($_POST["username"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
    $password=filter_var($_POST["password"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmedpassword=filter_var($_POST["confirmedPaasword"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userrole=filter_var($_POST["userrole"],FILTER_SANITIZE_NUMBER_INT);
    if(!$firstname || !$lastname || !$username || !$email ){
        $_SESSION["edit-user"]="Invalid from input on edit page";
    }elseif(strlen($password)<8){
        $_SESSION["edit-user"]="Please Enter Strong Password";
    }else{
        //  Check password and confirm password
        if($password !=$confirmedpassword){
            $_SESSION["edit-user"]="Not Matched password";
        }else{
            // password hashing algorithm
            $hashpassword=password_hash($password,PASSWORD_DEFAULT);
            $update_query="UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`username`='$username',`email`='$email',`password`='$hashpassword',`is_admin`='$userrole' WHERE id=$id LIMIT 1";
            $update_query_result=mysqli_query($connection,$update_query);
            if(mysqli_errno($connection)){
                $_SESSION["edit-user"]="Faild to Update User";
            }else{
                $_SESSION["edit-user-success"]="User Updated Successfully";
                header("Location:".ROOT_URL."admin/manage-users.php");
                die();
            }
        }
    }
}else{
    header("Location:".ROOT_URL."admin/edit-user.php");
    die();
}
?>