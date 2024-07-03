<?php
include "header.php";
include "../Model/AdminModel.php";

session_start();

if (isset($_GET['cat_id'])) {
    $_SESSION['cat_id'] = $_GET['cat_id'];
}

?>
<main class="main-prod">
    <div class="main-wrap-prod" id="wrap-prod-left">
        <form action="../Controller/add_product.php" method="post" enctype="multipart/form-data" class="form-prod">
            <input type="text" name="name" class="input-product" placeholder="Name">
            <input type="text" name="price" class="input-product" placeholder="Price">
            <input type="text" name="desc" class="input-product" placeholder="Description">
            <input type="file" name="img" id="input-product-img">
            <button id="btn-add-prod" name="action" value="add">Add product</button>
        </form>
        <a href="categories.php"><i class='bx bxs-left-arrow-circle'></i></a>
    </div>
    <div class="sidebar">
        <form action="../Controller/add_product.php" method="post" enctype="multipart/form-data" class="form-prod">
            <input type="text" name="name" class="input-product" placeholder="Name">
            <input type="text" name="price" class="input-product" placeholder="Price">
            <input type="text" name="desc" class="input-product" placeholder="Description">
            <input type="file" name="img" id="input-product-img">
            <button id="btn-add-prod" name="action" value="add">Add product</button>
        </form>
        <button class="sidebar-toggle"><i class='bx bx-sidebar'></i></button>
        <a href="categories.php"><i class='bx bxs-left-arrow-circle'></i></a>
    </div>

    <?php

    $adminModel = new AdminModel();
    $products = $adminModel->getProduct($_SESSION['cat_id']);
    ?>

    <div class="main-wrap-prod" id="wrap-prod-right">
        <?php
        foreach ($products as $product) { ?>
            <article id="<?= $product['id'] ?>" class="card">
                <img src="../Assets/images/<?= $product['image'] ?>" alt="Product Image">
                <div>
                    <h2 class="p-name" contenteditable><?= $product['name'] ?></h2>
                    <p class="p-price" contenteditable><?= $product['price'] ?>$</p>
                    <p class="p-desc" contenteditable><?= $product['description'] ?></p>
                </div>
                <div class="btn-s">
                    <button class="btn-upd">Update</button>
                    <button class="btn-del">Delete</button>
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
        $('.btn-upd').click(function () {
            let self = $(this).parents('.card');
            let id = self.attr('id');
            let name = self.find('.p-name').html();
            let desc = self.find('.p-desc').html();
            let price = self.find('.p-price').html();

            $.ajax({
                url: "../Controller/add_product.php",
                method: 'post',
                data: {
                    name, desc, price, id,
                    action: 'update'
                },
                success: () => {
                    location.reload();
                }
            })
        })

        $('.btn-del').click(function () {
            let id = $(this).parents('.card').attr('id');

            $.ajax({
                url: "../Controller/add_product.php",
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
