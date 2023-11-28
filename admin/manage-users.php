<?php
include '../admin/partials/header.php';
$cuurent_user_id=$_SESSION["user-id"];
$fetch_query="SELECT * FROM `users` WHERE NOT id=$cuurent_user_id";
$users=mysqli_query($connection,$fetch_query);
?>
<!-- ========start of dashboard -->
<section class="dashboard">
    <?php
        if(isset($_SESSION["add-user-success"])):
        ?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["add-user-success"]; // add user success message
                unset($_SESSION["add-user-success"]);
            ?>
        </p>
    </div>
    <?php 
        elseif(isset($_SESSION["edit-user-success"])):
    ?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["edit-user-success"]; // update user success message
          unset($_SESSION["edit-user-success"]);
        ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION["delete-user-success"])):?>
    <div class="alert__messsage success container">
        <p><?=$_SESSION["delete-user-success"]; // delete user success message
          unset($_SESSION["delete-user-success"]);
        ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION["delete-user"])):?>
    <div class="alert__messsage error container">
        <p><?=$_SESSION["delete-user"]; // delete  error message
          unset($_SESSION["delete-user"]);
        ?>
        </p>
    </div>
    <?php endif;?>
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
                    <h5>Manage Users</h5>
                </li>
                <?php
                }
                ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if(mysqli_num_rows($users)>0):?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user=mysqli_fetch_assoc($users)):?>
                    <tr>
                        <td><?="{$user["firstname"]}{$user["lastname"]}"?></td>
                        <td><?="{$user["username"]}"?></td>
                        <td><a href="<?=ROOT_URL?>admin/edit-user.php?id=<?=$user["id"]?>" class="btn sm">Edit</a>
                        </td>
                        <td>
                            <a href="<?=ROOT_URL?>admin/delete-user-logic.php?id=<?=$user["id"]?>"
                                class="btn sm danger">Delete</a>
                        </td>
                        <td><?=$user["is_admin"]?'Yes':'No'
                        ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
            <?php else:?>
            <div class="alert__messsage success container">
                <p>
                    There No Users found
                </p>
            </div>
            <?php endif;?>
        </main>
    </div>
</section>
<!-- ========End of dashboard -->
<?php
include '../partials/footer.php';
?>