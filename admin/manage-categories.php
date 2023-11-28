<?php
include '../admin/partials/header.php';
$fetch_query="SELECT * FROM `categories`";
$categories=mysqli_query($connection,$fetch_query);
?>
<!-- ========start of dashboard -->
<section class="dashboard">
    <?php if(isset($_SESSION['edit-category-success'])):?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["edit-category-success"]; //  edit category success message
                unset($_SESSION["edit-category-success"]);
            ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION['add-category-success'])):?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["add-category-success"]; //  add category success message
                unset($_SESSION["add-category-success"]);
            ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION['delete-category'])):?>
    <div class="alert__messsage error container">
        <p><?=$_SESSION["add-category"]; //  add category success message
                unset($_SESSION["add-category"]);
            ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION['delete-category-success'])):?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["delete-category-success"]; //  add category success message
                unset($_SESSION["delete-category-success"]);
            ?>
        </p>
    </div>
    <?php endif; ?>
    <div class="container dashboard__container">
        <button id="show-sidebar-btn" class="sidebar-toggle">
            <i class="uil uil-angle-right-b"></i>
        </button>
        <button id="hide-sidebar-btn" class="sidebar-toggle">
            <i class="uil uil-angle-left-b"></i>
        </button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i></a>
                    <h5>Add Post</h5>
                </li>
                <li>
                    <a href="index.php"><i class="uil uil-postcard"></i></a>
                    <h5>Manage Posts</h5>
                </li>
                <?php if(isset($_SESSION["user_is_admin"])){?>
                <li>
                    <a href="add-user.php"><i class="uil uil-user-plus"></i></a>
                    <h5>Add user</h5>
                </li>
                <li>
                    <a href="manage-users.php"><i class="uil uil-users-alt"></i></a>
                    <h5>Manage Users</h5>
                </li>
                <li>
                    <a href="add-category.php"><i class="uil uil-pen"></i></a>
                    <h5>Add Category</h5>
                </li>
                <li>
                    <a href="manage-categories.php">
                        <i class="uil uil-list-ul"></i></a>
                    <h5>Manage Categories</h5>
                </li>
                <?php 
                }
                ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($category=mysqli_fetch_assoc($categories)):?>
                    <tr>
                        <td><?= $category['title']?></td>
                        <td><?= $category['description']?></td>
                        <td><a href="<?=ROOT_URL?>admin/edit-category.php?id=<?=$category['id']?>"
                                class="btn sm">Edit</a>
                        </td>
                        <td>
                            <a href="<?=ROOT_URL?>admin/delete-category-logic.php?id=<?=$category['id']?>"
                                class="btn sm danger">Delete</a>
                        </td>
                    </tr>
                    <?php 
                    endwhile;
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</section>
<!-- ========End of dashboard -->

<?php
include '../partials/footer.php';
?>