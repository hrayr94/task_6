<?php
include "header.php";
include "../Model/UserModel.php";

$userModel = new UserModel();
$order_id = $_SESSION['user_id'];
$allOrderItems = $userModel->getAllOrderItems($order_id);

?>
<main>
<?php
if (!count($allOrderItems)) { ?>
    <main>
        <p class='p-mess'>Buy something!</p>
    </main>
<?php } else { ?>

<div class="order">
    <div class="order-item">
        <?php
        $bill = 0;
        foreach ($allOrderItems as $order_item) {
            $order_price = $order_item['price'];
            $order_quantity = $order_item['quantity'];
            ?>
            <article id="<?= $order_item['id'] ?>" class="card-order">
                <img src="../Assets/images/<?= $order_item['image'] ?>" alt="Image" width="200" height="200">
                <div class="order-desc">
                    <h2><?= $order_item['name'] ?></h2>
                    <p><?= $order_price ?>$</p>
                    <p><?= $order_item['description'] ?></p>
                </div>
                <div class="order-quantity">
                    <p>QUANTITY: <?= $order_quantity ?></p>
                </div>
            </article>
            <?php $bill = $bill + $order_price * $order_quantity ?>
        <?php } ?>
    </div>
    <div class="order-total">
        <p>TOTAL:</p>
        <p id="p-bill">$ <?= $bill ?></p>
    </div>
</div>
<?php } ?>
</main>

<?php
include "footer.php";
?>