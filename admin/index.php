<?php
include '../admin/partials/header.php';
$author_id=$_SESSION['user-id'];
$fetch_query="SELECT * FROM `posts` WHERE author_id = $author_id";
$posts=mysqli_query($connection,$fetch_query);

?>
<!-- ========start of dashboard -->
<section class="dashboard">
    <?php
    if(isset($_SESSION['edit-post-success'])):
    ?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["edit-post-success"]; // edit post success message
                unset($_SESSION["edit-post-success"]);
            ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION['add-post-success'])): ?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["add-post-success"]; // add post success message
                unset($_SESSION["add-post-success"]);
            ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION['delete-post'])): ?>
    <div class="alert__messsage error container">
        <p><?=$_SESSION["delete-post"]; // add post success message
                unset($_SESSION["delete-post"]);
            ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION['delete-post-success'])): ?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["delete-post-success"]; // add post success message
                unset($_SESSION["delete-post-success"]);
            ?>
        </p>
    </div>
    <?php endif; ?>
    <div class="container dashboard__container">
        <aside>
            <ul>
                <li>
                    <a href="<?=ROOT_URL?>admin/add-post.php"><i class="uil uil-pen"></i></a>
                    <h5>Add Post</h5>
                </li>
                <li>
                    <a href="<?=ROOT_URL?>admin/index.php"><i class="uil uil-postcard"></i></a>
                    <h5>Manage Posts</h5>
                </li>
                <?php if(isset($_SESSION["user_is_admin"])):?>
                <li>
                    <a href="<?=ROOT_URL?>admin/add-user.php"><i class="uil uil-user-plus"></i></a>
                    <h5>Add user</h5>
                </li>
                <li>
                    <a href="<?=ROOT_URL?>admin/manage-users.php"><i class="uil uil-users-alt"></i></a>
                    <h5>Manage Users</h5>
                </li>
                <li>
                    <a href="<?=ROOT_URL?>admin/add-category.php"><i class="uil uil-pen"></i></a>
                    <h5>Add Category</h5>
                </li>
                <li>
                    <a href="<?=ROOT_URL?>admin/manage-categories.php"><i class="uil uil-list-ul"></i></a>
                    <h5>Manage Categories</h5>
                </li>
                <?php
                 endif;
                ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Posts</h2>
            <?php if(mysqli_num_rows($posts)>0):?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($post=mysqli_fetch_assoc($posts)):?>
                    <tr>
                        <td><?= $post['title']?></td>
                        <td><?= $post['body']?></td>
                        <?php
                        $category_id=$post['category_id'];
                        $fetch_category="SELECT `title` FROM `categories` WHERE id=$category_id";
                        $fetch_result=mysqli_query($connection,$fetch_category);
                        $category=mysqli_fetch_assoc($fetch_result);
                        ?>
                        <td><?=$category['title']?></td>
                        <td><a href="<?=ROOT_URL?>admin/edit-post.php?id=<?=$post['id']?>" class="btn sm">Edit</a>
                        </td>
                        <td>
                            <a href="<?=ROOT_URL?>admin/delete-post-logic.php?id=<?=$post['id']?>"
                                class="btn sm danger">Delete</a>
                        </td>
                    </tr>
                    <?php 
                    endwhile;
                    ?>
                </tbody>
            </table>
            <?php else : ?>
            <div class="alert__messsage success container">
                <p>
                    There No Posts found
                </p>
            </div>
            <?php endif;?>
        </main>
    </div>
</section>
<!-- ========End of dashboard -->
<!-- start of footer -->
<?php
include '../partials/footer.php';
?>