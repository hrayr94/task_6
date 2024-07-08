<?php

include "user/View/header.php";
require_once 'admin/Model/DB.php';
require_once 'admin/Model/ProductModel.php';

function displayProducts()
{
    $userModel = new DB();
    $pdo = $userModel->getConnection();
    $productModel = new ProductModel($pdo);
    $products = $productModel->getProducts();

    foreach ($products as $product) {
        ?>
        <div class="col-md-4 mb-4">
            <div id="<?= $product['id'] ?>" class="card shadow-sm">
                <img src="admin/Assets/images/<?= $product['image'] ?>" class="card-img-top product-img img-fluid"
                     alt="Product Image" style="object-fit: cover; height: 300px;">
                <div class="card-body">
                    <h5 class="card-title p-name"><?= $product['name'] ?></h5>
                    <p class="card-text p-price"><?= $product['price'] ?>$</p>
                    <p class="card-text p-desc"><?= $product['description'] ?></p>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-primary btn-add-to-cart">Add to Cart</button>
                        <button class="btn btn-outline-success btn-add-to-order">Add to Order</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

?>

<main class="container my-5">
    <div class="row">
        <?php displayProducts(); ?>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="user/Assets/js/products.js"></script>
<?php
include "user/View/footer.php";
?>
