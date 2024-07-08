<?php

include "header.php";
include "../Model/ProductModel.php";


$productModel = new ProductModel();
$products = $productModel->getProducts();
?>
<main>

    <?php
    if (!count($products)) : ?>
        <p class='p-mess'>There are <span>NO</span> products!</p>
    <?php else : ?>

        <h1 class="p-mess"></h1>
        <div class="product">
            <?php
            foreach ($products as $product) : ?>
                <article id="<?= $product['id'] ?>" class="card">
                    <img src="../Assets/images/<?= $product['image'] ?>" alt="Image">
                    <div id="desc-box">
                        <h2 class="p-name"><?= $product['name'] ?></h2>
                        <p class="p-price"><?= $product['price'] ?>$</p>
                        <p class="p-desc"><?= $product['description'] ?></p>
                    </div>
                    <?php
                    if (empty($_SESSION['user_id'])) : ?>
                        <p id="login-error">To add product in Cart or Wish List please SIGN IN!</p>
                    <?php else : ?>
                        <div id="btn-box">
                            <button class="btn-add" title="Add to Cart"><i class='bx bxs-cart-download'></i></button>
                            <p>ADD</p>
                            <button class="btn-wish" title="Add to Wish List"><i class='bx bxs-heart'></i></button>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php
include "footer.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="../Assets/js/products.js"></script>























