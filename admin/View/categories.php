<?php
include "header.php";
include "../Model/AdminModel.php";

session_start();

if (!isset($_SESSION['admin'])) {
    header('location: ../index.php');
    die;
}
?>
<main class="main-cat">
    <div class="main-wrap" id="main-wrap-left">
        <div class="main-inner" id="main-inner-info">
            <h1>Welcome home, <?= ucfirst($_SESSION['admin']) ?>!</h1>
            <ul>
                <li><p>To add category click "Add"</p></li>
                <li><p>To rename category click on the name, rename it, then click "Update"</p></li>
                <li><p>To delete category click "Delete"</p></li>
                <li><p>To show category and products click on "Arrow"</p></li>
            </ul>
        </div>
        <div class="main-inner" id="main-inner-add-cat">
            <label>Add Categories:
                <input type="text" id="input-cat" name="input-cat">
            </label>
            <button id="btn-add" name="add">Add</button>
            <p id="p-mess"></p> <!-- todo response not working -->
        </div>
    </div>
    <div class="sidebar">
        <form action="../Controller/add_category.php" method="post">
            <label>Add Categories:
                <input type="text" id="input-cat" name="name">
            </label>
            <button id="btn-add" name="action" value="add">Add</button>
        </form>
        <button class="sidebar-toggle"><i class='bx bx-sidebar'></i></button>
        <div style="margin: 50px 10px;">
            <h1>Welcome home, <?= ucfirst($_SESSION['admin']) ?>!</h1>
            <ul>
                <li><p>To add category click "Add"</p></li>
                <li><p>To rename category click on the name, rename it, then click "Update"</p></li>
                <li><p>To delete category click "Delete"</p></li>
                <li><p>To show category and products click on "Arrow"</p></li>
            </ul>
        </div>
    </div>
    <?php

    $adminModel = new AdminModel();
    $categories = $adminModel->getCategories();

    ?>
    <div class="main-wrap" id="main-wrap-right">
        <?php
        foreach ($categories as $category) { ?>
            <article id="<?= $category['id'] ?>" class="inner-cat">
                <h2 contenteditable><?= strtoupper($category['name']) ?></h2>
                <div class="inner-cat-buttons">
                    <button class="btn-upd">Update</button>
                    <button class="btn-del">Delete</button>
                    <a href="products.php?cat_id=<?= $category['id'] ?>">
                        <i class='bx bxs-right-arrow-circle'></i>
                    </a>
                </div>
            </article>
        <?php } ?>
    </div>

</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(function () {
        $('.sidebar-toggle').click(function () {
            $('.sidebar').toggleClass('toggle');
        });
        $('#btn-add').click(function () {
            let name = $('#input-cat').val();

            $.ajax({
                url: "../Controller/add_category.php",
                method: 'post',
                dataType: 'html',
                data: {
                    name,
                    action: 'add'
                },
                success: (response) => {
                    if (response === 'error') {
                        $('#p-mess').html('Empty field');
                    } else {
                        location.reload();
                    }
                }
            })
        })

        $('.btn-upd').click(function () {
            let id = $(this).parents('.inner-cat').attr('id');
            let name = $(this).parents('.inner-cat').find('h2').html();

            $.ajax({
                url: "../Controller/add_category.php",
                method: 'post',
                data: {
                    id, name,
                    action: 'update'
                },
                success: () => {
                    location.reload();
                }
            })
        })

        $('.btn-del').click(function () {
            let id = $(this).parents('.inner-cat').attr('id');

            $.ajax({
                url: "../Controller/add_category.php",
                method: 'post',
                data: {
                    id,
                    action: 'delete'
                },
                success: () => {
                    location.reload();
                }
            })
        })
    })
</script>

<?php
include "footer.php";
?>
