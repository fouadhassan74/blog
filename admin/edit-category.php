<?php
include '../admin/partials/header.php';
if(isset($_GET['id'])){
    $id=filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query="SELECT * FROM `categories` WHERE id=$id";
    $result=mysqli_query($connection,$query);
    $category=mysqli_fetch_assoc($result);
    if(mysqli_errno($connection)){
        header("location:".ROOT_URL."admin/manage-category.php");
        die();
    }
}
else{
    header('location:'.ROOT_URL.'/admin/manage-categories.php');
    die();
}
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
        <?php
           if(isset($_SESSION['edit-category'])):
        ?>
        <div class="alert__messsage error">
            <p><?=$_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?></p>
        </div>
        <?php
           endif;
        ?>
        <form action="<?=ROOT_URL?>admin/edit-category-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$id?> type=" text" placeholder="Title" />
            <input value="<?=$category['title']?>" name="title" type="text" placeholder="Title" />
            <textarea name="description" rows="4" type="text"
                placeholder="Description"> <?=$category['description']?></textarea>
            <button class="btn" name="submit" type="submit">Update category</button>
        </form>
    </div>
</section>
<?php
include '../partials/footer.php';
?>