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
$cartItems = $userModel->getCartItems($user_id);

?>
<main>
<?php

if (!count($cartItems)) { ?>
    <p class='p-mess'>Your <span>Cart</span> is empty!</p>
<?php } else { ?>

<div class="cart">
    <div class="product-cart">
        <?php
        $total = 0;
        foreach ($cartItems as $cart_item) {
            $price = $cart_item['price'];
            $quantity = $cart_item['quantity'];
            $sum = $price * $quantity;
            $total += $sum;
            ?>
            <article id="<?= $cart_item['id'] ?>" class="card-cart">
                <img src="../Assets/images/<?= $cart_item['image'] ?>" alt="Image" width="200" height="200">
                <div id="desc-cart">
                    <h2 class="cart-name"><?= $cart_item['name'] ?></h2>
                    <p class="cart-price"><?= $cart_item['price'] ?>$</p>
                    <p class="cart-desc"><?= $cart_item['description'] ?></p>
                </div>
                <div id="btn-cart">
                    <p>Quantity:</p>
                    <div class="btn-quantity">
                        <button class="minus" title="Remove"><i class='bx bxs-minus-circle'></i></button>
                        <p class="quantity"><?=$quantity?></p>
                        <button class="plus" title="Add"><i class='bx bxs-plus-circle'></i></button>
                    </div>
                    <div>
                        <button class="btn-remove">Remove</button>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
    <div class="cart-total">
        <div class="cart-total-inner">
            <p>TOTAL:</p>
            <p class='total'>$ <?= $total?></p>
            <?php
            $_SESSION['total'] = $total;
            ?>
        </div>
        <a id="btn-buy" href="../Controller/buy.php">Buy</a>
    </div>
</div>
<?php } ?>
</main>

<?php
include "footer.php";
?>






















