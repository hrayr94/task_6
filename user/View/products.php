<?php

include "header.php";
include "../Model/UserModel.php";

if (isset($_GET['cat_id'])) {
    $_SESSION['cat_id'] = $_GET['cat_id'];
}

$userModel = new UserModel();
$products = $userModel->getProducts($_SESSION['cat_id']);
?>
<main>

<?php
if (!count($products)) { ?>
    <p class='p-mess'>There are <span>NO</span> products!</p>
<?php } else { ?>

<h1 class="p-mess"></h1>
<div class="product">
    <?php
    foreach ($products as $product) { ?>
        <article id="<?= $product['id'] ?>" class="card">
            <img src="../Assets/images/<?= $product['image'] ?>" alt="Image">
            <div id="desc-box">
                <h2 class="p-name"><?= $product['name'] ?></h2>
                <p class="p-price"><?= $product['price'] ?>$</p>
                <p class="p-desc"><?= $product['description'] ?></p>
            </div>
            <?php
            if (empty($_SESSION['user_id'])) { ?>
                <p id="login-error">To add product in Cart or Wish List please SIGN IN!</p>
            <?php } else { ?>
                <div id="btn-box">
                    <button class="btn-add" title="Add to Cart"><i class='bx bxs-cart-download' ></i></button>
                    <p>ADD</p>
                    <button class="btn-wish" title="Add to Wish List"><i class='bx bxs-heart' ></i></button>
                </div>
            <?php } ?>
        </article>
    <?php } ?>
</div>
<?php } ?>
</main>

<?php
include "footer.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(function () {
        $('.btn-add').click(function () {
            let product_id = $(this).parents('.card').attr('id');

            $.ajax({
                url: "../Controller/add_to_cart.php",
                method: "post",
                dataType: "json",
                data: {
                    product_id,
                    action: "add"
                },
                success: (response) => {
                    if (!response.success) {
                        $('.p-mess').html("Product already in <span>Cart</span>!")
                    } else {
                        $('.p-mess').html("Product was added in <span>Cart</span> successfully!")
                    }
                }
            })
        })
        $('.btn-wish').click(function () {
            let product_id = $(this).parents('.card').attr('id');

            $.ajax({
                url: "../Controller/add_to_wish.php",
                method: "post",
                dataType: "json",
                data: {
                    product_id,
                    action: "add"
                },
                success: (response) => {
                    if (!response.success) {
                        $('.p-mess').html("Product already in <span>Wish List</span>!")
                    } else {
                        $('.p-mess').html("Product was added in <span>Wish List</span> successfully!")
                    }
                }
            })
        })
    })
</script>























