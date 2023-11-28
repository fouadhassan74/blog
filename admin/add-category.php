<?php
include '../admin/partials/header.php';
$title=$_SESSION["add-category-data"]["title"]??null;
$description=$_SESSION["add-category-data"]["description"]??null;
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php if(isset($_SESSION["add-category"])):?>
        <div class="alert__messsage error">
            <p><?=$_SESSION["add-category"];
            unset($_SESSION["add-category"]);
            ?></p>
        </div>
        <?php endif; ?>
        <form method="POST" action="<?=ROOT_URL?>admin/add-category-logic.php" enctype="multipart/form-data">
            <input value="<?=$title?>" name="title" type="text" placeholder="Title" />
            <textarea value="<?=$description?>" name="description" rows="4" placeholder="Description"></textarea>
            <button name="submit" type="submit" class="btn" type="submit">Add category</button>
        </form>
    </div>
</section>
<?php
include '../partials/footer.php'
?>