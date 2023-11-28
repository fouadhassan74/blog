<?php
include "./partials/header.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $get_category_query="SELECT * FROM `categories` WHERE id=$id";
    $get_posts_query="SELECT * FROM `posts` WHERE category_id=$id";
    $get_category_result=mysqli_query($connection,$get_category_query);
    $category=mysqli_fetch_assoc($get_category_result);
    $get_posts_result=mysqli_query($connection,$get_posts_query);
}
?>
<!-- =======start of header====== -->
<header class="category__title">
    <h2><?=$category['title']?></h2>
</header>
<!-- =======end of header======= -->
<!-- start of posts -->
<section class="posts">
    <div class="container posts__container">
        <?php while($post=mysqli_fetch_assoc($get_posts_result)):?>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/<?=$post['thumbnails']?>" alt="" />
            </div>
            <div class="post__info">
                <a href="category-posts.php?id=<?=$id?>" class="category__button"><?=$category['title']?></a>
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
<!-- <section class="posts">
    <div class="container posts__container">
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/blog1.jpg" alt="" />
            </div>
            <div class="post__info">
                <a href="category-post.html" class="category__button">wild life</a>
                <h3 class="post__title">
                    <a href="post.html">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quia.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Distinctio accusantium, repudiandae excepturi sit dolorem nulla
                    eius laboriosam eum saepe, nemo laborum ea amet perspiciatis ab
                    assumenda? Optio autem ratione in.
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg" alt="" />
                    </div>
                    <div class="post__author-info">
                        <h5>by:june do</h5>
                        <small>june 10 , 2022 - 7.20am</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/blog1.jpg" alt="" />
            </div>
            <div class="post__info">
                <a href="category-post.html" class="category__button">wild life</a>
                <h3 class="post__title">
                    <a href="post.html">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quia.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Distinctio accusantium, repudiandae excepturi sit dolorem nulla
                    eius laboriosam eum saepe, nemo laborum ea amet perspiciatis ab
                    assumenda? Optio autem ratione in.
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg" alt="" />
                    </div>
                    <div class="post__author-info">
                        <h5>by:june do</h5>
                        <small>june 10 , 2022 - 7.20am</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/blog2.jpg" alt="" />
            </div>
            <div class="post__info">
                <a href="" class="category__button">wild life</a>
                <h3 class="post__title">
                    <a href="post.html">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quia.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Distinctio accusantium, repudiandae excepturi sit dolorem nulla
                    eius laboriosam eum saepe, nemo laborum ea amet perspiciatis ab
                    assumenda? Optio autem ratione in.
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg" alt="" />
                    </div>
                    <div class="post__author-info">
                        <h5>by:june do</h5>
                        <small>june 10 , 2022 - 7.20am</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/blog20.jpg" alt="" />
            </div>
            <div class="post__info">
                <a href="" class="category__button">wild life</a>
                <h3 class="post__title">
                    <a href="post.html">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quia.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Distinctio accusantium, repudiandae excepturi sit dolorem nulla
                    eius laboriosam eum saepe, nemo laborum ea amet perspiciatis ab
                    assumenda? Optio autem ratione in.
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg" alt="" />
                    </div>
                    <div class="post__author-info">
                        <h5>by:june do</h5>
                        <small>june 10 , 2022 - 7.20am</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/blog22.jpg" alt="" />
            </div>
            <div class="post__info">
                <a href="" class="category__button">wild life</a>
                <h3 class="post__title">
                    <a href="post.html">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quia.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Distinctio accusantium, repudiandae excepturi sit dolorem nulla
                    eius laboriosam eum saepe, nemo laborum ea amet perspiciatis ab
                    assumenda? Optio autem ratione in.
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg" alt="" />
                    </div>
                    <div class="post__author-info">
                        <h5>by:june do</h5>
                        <small>june 10 , 2022 - 7.20am</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/blog13.jpg" alt="" />
            </div>
            <div class="post__info">
                <a href="" class="category__button">wild life</a>
                <h3 class="post__title">
                    <a href="post.html">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quia.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Distinctio accusantium, repudiandae excepturi sit dolorem nulla
                    eius laboriosam eum saepe, nemo laborum ea amet perspiciatis ab
                    assumenda? Optio autem ratione in.
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg" alt="" />
                    </div>
                    <div class="post__author-info">
                        <h5>by:june do</h5>
                        <small>june 10 , 2022 - 7.20am</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/blog12.jpg" alt="" />
            </div>
            <div class="post__info">
                <a href="" class="category__button">wild life</a>
                <h3 class="post__title">
                    <a href="post.html">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quia.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Distinctio accusantium, repudiandae excepturi sit dolorem nulla
                    eius laboriosam eum saepe, nemo laborum ea amet perspiciatis ab
                    assumenda? Optio autem ratione in.
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg" alt="" />
                    </div>
                    <div class="post__author-info">
                        <h5>by:june do</h5>
                        <small>june 10 , 2022 - 7.20am</small>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section> -->
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
include "./partials/footer.php"
?>