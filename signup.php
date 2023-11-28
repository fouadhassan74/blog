<?php
require "./config/constants.php";
//get back data if there an error
$firstname=$_SESSION['signup-data']['firstname']??null;
$lastname=$_SESSION['signup-data']['lastname']??null;
$username=$_SESSION['signup-data']['username']??null;
$email=$_SESSION['signup-data']['email']??null;
$createpassword=$_SESSION['signup-data']['createpassword']??null;
$confirmpassword=$_SESSION['signup-data']['confirmpassword']??null;
// delete data at end of session
unset($_SESSION['signup-data']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- style link -->
    <link rel="stylesheet" href="<?=ROOT_URL?>css/styles.css" />
    <!-- Iconscout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <title>blog</title>
</head>

<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign Up</h2>
            <?php
           if(isset($_SESSION['signup'])){
           ?>
            <div class="alert__messsage error">
                <p><?=$_SESSION['signup'];
                unset($_SESSION['signup']);
                ?></p>
            </div>
            <?php
           }
            ?>
            <form action="<?=ROOT_URL?>signup-logic.php" method="post" enctype="multipart/form-data">
                <input type="text" value="<?=$firstname?>" name="firstname" placeholder="First Name" />
                <input type="text" value="<?=$lastname?>" name="lastname" placeholder="Second Name" />
                <input type="text" value="<?=$username?>" name="username" placeholder="Username" />
                <input type="emial" value="<?=$email?>" name="email" placeholder="Email" />
                <input type="password" value="<?=$createpassword?>" name="createpassword" placeholder="Password" />
                <input type="password" value="<?=$confirmpassword?>" name="confirmpassword"
                    placeholder="Confirm Password" />
                <div class="form__control">
                    <label for="avatar"></label>
                    <input type="file" name="avatar" id="avatar" />
                </div>
                <button class="btn" name="submit" type="submit">Sign Up</button>
                <small>ALready have an account?<a href="signin.php">Sign in</a></small>
            </form>
        </div>
    </section>
</body>

</html>