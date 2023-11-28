<?php
include '../admin/partials/header.php';
if(isset($_GET["id"])){
    $id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
    $query="SELECT * FROM `users` WHERE id=$id";
    $result=mysqli_query($connection,$query);
    $user=mysqli_fetch_assoc($result);
    if(mysqli_error($connection)){
    header("Location:".ROOT_URL."admin/manage-users.php");
    die();
    }
}else{
    header("Location:".ROOT_URL."admin/manage-users.php");
    die();
}
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
        <?php
           if(isset($_SESSION['edit-user'])):
        ?>
        <div class="alert__messsage error">
            <p><?=$_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?></p>
        </div>
        <?php
           endif;
        ?>
        <form method="post" action="<?=ROOT_URL?>admin/edit-user-logic.php">
            <input type="hidden" name="id" value="<?=$id?>" />
            <input type="text" name="firstname" value="<?=$user["firstname"]?>" placeholder="First Name" />
            <input type="text" name="lastname" value="<?=$user["lastname"]?>" placeholder="Last Name" />
            <input type="text" name="username" value="<?=$user["username"]?>" placeholder="Username" />
            <input type="emial" name="email" value="<?=$user["email"]?>" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />
            <input type="password" name="confirmedPaasword" placeholder="Confirm Password" />
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <button class="btn" name="submit" type="submit">Update User</button>
        </form>
    </div>
</section>
<?php
include '../partials/footer.php';
?>