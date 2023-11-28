<?php
 include './partials/header.php'
 ?>
<!-- =========start of featured -->
<!-- fetch the featured post -->
<?php
$fetch_query="SELECT * FROM `posts` WHERE is_featured=1";
$fetch_result=mysqli_query($connection,$fetch_query);
if(mysqli_num_rows($fetch_result)==1){
$featured_post=mysqli_fetch_assoc($fetch_result);
}else{
    $featured_post=array();
}
?>
<section class="featured">
    <div class="container featured__container">
        <div class="post__thumbnail">
            <img src="./images/<?=$featured_post['thumbnails']?>" alt="" />
        </div>
        <div class="post__info">
            <?php
            $id=$featured_post['category_id'];
            $fetch_category_name="SELECT `title` FROM `categories` WHERE id=$id";
            $fetch_result=mysqli_query($connection,$fetch_category_name);
            $name=mysqli_fetch_assoc($fetch_result);
            ?>
            <a href="category-posts.php?id=<?=$id?>" class="category__button"><?=$name['title']?></a>
            <h2 class="post__title">
                <a href="post.php?id=<?=$featured_post['id']?>">
                    <?=substr($featured_post['title'],0,150)?>....
                </a>
            </h2>
            <p class="post__body">
                <?=substr($featured_post['body'],0,150)?>....
            </p>
            <?php
            $user_id=$featured_post['author_id'];
            $get_autor_query="SELECT * FROM `users` WHERE id=$user_id";
            $get_autor_result=mysqli_query($connection,$get_autor_query);
            $user=mysqli_fetch_assoc($get_autor_result);
            ?>
            <div class="post__author">
                <div class="post__author-avatar">
                    <img src="./images/<?=$user['avatar']?>" alt="" />
                </div>
                <div class="post__author-info">
                    <h5>by:<?php
                    echo"{$user['firstname']}{$user['lastname']}";
                    ?></h5>
                    <small><?=date("M d, Y - H:i",strtotime($featured_post['date_time']))?></small>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======End of featured -->
<!-- start of posts -->
<?php
$get_posts_query="SELECT * FROM `posts` LIMIT 9";
$get_posts_result=mysqli_query($connection,$get_posts_query);
?>
<section class="posts">
    <div class="container posts__container">
        <?php while($post=mysqli_fetch_assoc($get_posts_result)):?>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/<?=$post['thumbnails']?>" alt="" />
            </div>
            <?php
            $id=$post['category_id'];
            $fetch_category_name="SELECT `title` FROM `categories` WHERE id=$id";
            $fetch_result=mysqli_query($connection,$fetch_category_name);
            $name=mysqli_fetch_assoc($fetch_result);
            ?>
            <div class="post__info">
                <a href="category-posts.php?id=<?=$id?>" class="category__button"><?=$name['title']?></a>
                <h3 class="post__title">
                    <a href="post.php?id=<?=$post['id']?>">
                        <?=$post['title']?>
                    </a>
                </h3>
                <p class="post__body">
                    <?=substr($post['body'],0,150)?>....
                </p>
                <?php
                        $user_id=$post['author_id'];
                        $get_autor_query="SELECT * FROM `users` WHERE id=$user_id";
                        $get_autor_result=mysqli_query($connection,$get_autor_query);
                        $user=mysqli_fetch_assoc($get_autor_result);
                    ?>
                <div class="post__author">
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
            </div>
        </article>
        <?php endwhile;?>
    </div>
</section>
<!-- end of posts -->
<!-- start of buttons -->

<?php
$fetch_categories="SELECT * FROM `categories`";
$fetch_result=mysqli_query($connection,$fetch_categories);
$categories=mysqli_fetch_assoc($fetch_result);
?>
<section class="category__buttons">
    <div class="container category__buttons-container">
        <a href="" class="category__button">Category</a>
        <?php while($categories=mysqli_fetch_assoc($fetch_result)):?>
        <a href="" class="category__button"><?=$categories['title']?></a>
        <?php endwhile;?>
    </div>
</section>
<!-- end of buttons -->
<?php
require "./partials/footer.php"
?>