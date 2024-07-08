<?php

use Model\DB;

include "header.php";
include "../Model/DB.php";

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please log in first";
    header('location: login_form.php');
    die;
}

$userModel = new DB();
$user_id = $_SESSION['user_id'];
$wishItems = $userModel->getWishItems($user_id);

?>
<main>
<?php

if (!count($wishItems)) { ?>
    <p class='p-mess'>Your <span>Wish List</span> is empty!</p>
<?php } else { ?>

<h1 class="p-mess"></h1>
<div class="product-wish">
    <?php
    foreach ($wishItems as $wish_item) {
        $price = $wish_item['price'];
        $prod_id = $wish_item['product_id'];
        ?>
        <article id="<?= $wish_item['id'] ?>" class="card-wish">
            <img src="../Assets/images/<?= $wish_item['image'] ?>" alt="Image" width="200" height="200">
            <div class="desc-wish">
                <h2 class="cart-name"><?= $wish_item['name'] ?></h2>
                <p class="cart-price">$ <?=$price?></p>
                <p class="cart-desc"><?=$wish_item['description']?></p>
            </div>
            <div id="btn-wish">
                <button id="<?=$prod_id?>" class="btn-wish-to-cart">Add to Cart</button>
                <button class="btn-remove-wish">Remove</button>
            </div>
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
        $('.btn-wish-to-cart').click(function () {
            let product_id = $(this).attr('id');

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
        $('.btn-remove-wish').click(function () {
            let product_id = $(this).parents('.card-wish').attr('id');

            $.ajax({
                url: "../Controller/add_to_wish.php",
                method: "post",
                data: {
                    product_id,
                    action: "delete"
                },
                success: () => {
                    location.reload();
                }
            })
        })
    })
</script>