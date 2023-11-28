<?php
require "./config/database.php";
$email_username=$_SESSION["signin-data"]["email-username"]??null;
$password=$_SESSION["signin-data"]["password"]??null;
unset($_SESSION["signin-data"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- style link -->
    <link rel="stylesheet" href="./css/styles.css" />
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
            <h2>Sign in</h2>
            <?php
            if(isset($_SESSION["signup-success"])){
            ?>
            <div class="alert__messsage success">
                <p><?=$_SESSION["signup-success"];
                unset($_SESSION["signup-success"]);
                ?></p>
            </div>
            <?php
                }else if(isset($_SESSION["signin"])){
            ?>
            <div class="alert__messsage error">
                <p><?=$_SESSION["signin"];
                unset($_SESSION["signin"]);
                ?></p>
            </div>
            <?php
                }
            ?>
            <form action="<?=ROOT_URL?>signin-logic.php" method="post">
                <input type="text" value="<?=$email_username?>" name="email-username" placeholder="Username or Email" />
                <input type="text" value="<?=$password?>" name="password" placeholder="Password" />
                <button class="btn" name="submit" type="submit">Sign Up</button>
                <small>ALready have an account?<a href="signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>
</body>

</html>