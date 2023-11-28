<?php
include '../admin/partials/header.php';
$fetch_categories="SELECT * FROM `categories`";
$title=$_SESSION['edit-post-data']['title']??null;
$body=$_SESSION['edit-post-data']['body']??null;
$fetch_result=mysqli_query($connection,$fetch_categories);
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query_post="SELECT * FROM `posts` WHERE id=$id";
    $fetch_post_result=mysqli_query($connection,$query_post);
    $post=mysqli_fetch_assoc($fetch_post_result);
}
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
        <?php
            if(isset($_SESSION['edit-post'])):
        ?>
        <div class="alert__messsage error">
            <p><?=$_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?></p>
        </div>
        <?php
            endif;
        ?>
        <form method="POST" action="<?=ROOT_URL?>admin/edit-post-logic.php" enctype="multipart/form-data">
            <input type="hidden" name='id' value=<?=$id?>>
            <input value="<?=$post['thumbnails'] ?>" type="hidden" name='previous_thumbnail_name'>
            <input value="<?=$post['title'] ??$title?>" name="title" type="text" placeholder="tilte" />
            <select name="category">
                <?php while ($category=mysqli_fetch_assoc($fetch_result)):?>
                <option value="<?=$category['id']?>"><?=$category['title']?></option>
                <?php endwhile; ?>
            </select>
            <div class="form__control">
                <input name="is_featured" type="checkbox" checked id="is_featured" />
                <label for="is_featured">Featred</label>
            </div>
            <textarea value="<?=$post['body']?>" rows="10" name="body"
                placeholder="Body"><?=$post['body'] ??$body?></textarea>
            <div class="form__control">
                <label for="thumbnail"></label>
                <input name="thumbnail" type="file" id="thumbnail" />
            </div>
            <button name="submit" class="btn" type="submit">Update Post</button>
        </form>
    </div>
</section>
<?php
include '../partials/footer.php';
?>