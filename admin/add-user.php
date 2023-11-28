<?php
include '../admin/partials/header.php';
$firstname=$_SESSION["add-user-data"]["firstname"]??null;
$lastname=$_SESSION["add-user-data"]["lastname"]??null;
$uesrname=$_SESSION["add-user-data"]["username"]??null;
$email=$_SESSION["add-user-data"]["email"]??null;
$password=$_SESSION["add-user-data"]["password"]??null;
$createpassword=$_SESSION["add-user-data"]["createpassword"]??null;
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        <?php if(isset($_SESSION["add-user"])):?>
        <div class="alert__messsage error">
            <p>
                <?=$_SESSION['add-user'];
                unset($_SESSION['add-user']);
                ?>
            </p>
        </div>
        <?php endif;?>
        <form action="<?=ROOT_URL?>/admin/add-user-logic.php" method="post" enctype="multipart/form-data">
            <input type="text" name="firstname" value="<?=$firstname?>" placeholder="First Name" />
            <input type="text" name="lastname" value="<?=$lastname?>" placeholder="Second Name" />
            <input type="text" name="username" value="<?=$uesrname?>" placeholder="Username" />
            <input type="emial" name="email" value="<?=$email?>" placeholder="Email" />
            <input type="password" name="password" value="<?=$password?>" placeholder="Password" />
            <input type="password" name="confirmedpassword" value="<?=$createpassword?>"
                placeholder="Confirm Password" />
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form__control">
                <label for="avatar"></label>
                <input name="avatar" type="file" id="avatar" />
            </div>

            <button name="submit" class="btn" type="submit">Add Post</button>
        </form>
    </div>
</section>
<?php
include '../partials/footer.php';
?>