<?php
include "./partials/header.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $get_post_query="SELECT * FROM `posts` WHERE id=$id";
    $get_post_result=mysqli_query($connection,$get_post_query);
    $post=mysqli_fetch_assoc($get_post_result);
}
?>
<!-- =========start of single post============ -->
<section class="singlepost">
    <div class="container singlepost__container">
        <h2>
            <?=$post['title']?>
        </h2>
        <div class="post__author">
            <?php
            $author_id=$post['author_id'];
            $get_user_query="SELECT * FROM `users` WHERE id= $author_id";
            $get_user_result=mysqli_query($connection,$get_user_query);
            $user=mysqli_fetch_assoc($get_user_result);
            ?>
            <div class="post__author-avatar">
                <img src="./images/<?=$user['avatar']?>" alt="" />
            </div>
            <div class="post__author-info">
                <h5>by:<?php
                echo"{$user['firstname']}{$user['lastname']}";
                ?></h5>
                <small><?=date("M d, Y - H:i",strtotime($post['date_time']))?></small>
            </div>
        </div>
        <div class="singlepost__thumbnail">
            <img src="./images/<?=$post['thumbnails']?>" alt="" />
        </div>
        <p>
            <?=$post['body']?>
        </p>
        <p>
            <?=$post['body']?>
        </p>
        <p>
            <?=$post['body']?>
        </p>
        <p>
            <?=$post['body']?>
        </p>
    </div>
</section>
<!-- ========end of single post======= -->
<!-- start of footer -->
<?php
include "./partials/footer.php"
?>