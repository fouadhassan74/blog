<?php
include '../admin/partials/header.php';
$fetch_query="SELECT * FROM `categories`";
$fetch_result=mysqli_query($connection,$fetch_query);
$title=$_SESSION['add-post-data']['title']??null;
$body=$_SESSION['add-post-data']['body']??null;
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <?php
        if(isset($_SESSION['add-post'])):
        ?>
        <div class="alert__messsage error">
            <p><?=$_SESSION['add-post'];
            unset($_SESSION['add-post']);
            ?></p>
        </div>
        <?php endif; ?>
        <form method="POST" action="<?=ROOT_URL?>admin/add-post-logic.php" enctype="multipart/form-data">
            <input value="<?=$title?>" type="text" name="title" placeholder="Tilte" />
            <select name="category">
                <?php while ($category=mysqli_fetch_assoc($fetch_result)):?>
                <option value="<?=$category['id']?>"><?=$category['title']?></option>
                <?php endwhile; ?>
            </select>
            <?php if(isset($_SESSION['user_is_admin'])):?>
            <div class="form__control">
                <input name="is_featured" value="1" type="checkbox" checked id="is_featured" />
                <label for="is_featured">Featred</label>
            </div>
            <?php endif; ?>
            <textarea name="body" rows="10" placeholder="Body"><?=$body?></textarea>
            <div class="form__control">
                <label for="thumbnail"></label>
                <input name="thumbnail" type="file" id="thumbnail" />
            </div>
            <button name="submit" class="btn" type="submit">Add Post</button>
        </form>
    </div>
</section>
<?php
include '../partials/footer.php'
?>