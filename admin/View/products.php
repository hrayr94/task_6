<?php
include "header.php";
require_once '../Model/ProductModel.php';

session_start();

if (isset($_GET['cat_id'])) {
    $_SESSION['cat_id'] = $_GET['cat_id'];
}

?>
<main class="container my-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <form action="../Controller/add_product.php" method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label for="productName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="productName" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Price</label>
                    <input type="text" name="price" class="form-control" id="productPrice" placeholder="Price">
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Description</label>
                    <input type="text" name="desc" class="form-control" id="productDescription" placeholder="Description">
                </div>
                <div class="mb-3">
                    <label for="productImage" class="form-label">Image</label>
                    <input type="file" name="img" class="form-control" id="productImage">
                </div>
                <button id="btn-add-prod" name="action" value="add" class="btn btn-primary">Add product</button>
            </form>
        </div>

        <div class="col-md-8">
            <div class="row">
                <?php
                $adminModel = new AdminModel();
                $pdo = $adminModel->getConnection();
                $productModel = new ProductModel($pdo);
                $products = $productModel->getProducts();

                foreach ($products as $product) : ?>
                    <div class="col-md-4 mb-4">
                        <div id="<?= $product['id'] ?>" class="card shadow-sm">
                            <img src="../Assets/images/<?= $product['image'] ?>" class="card-img-top product-img img-fluid" alt="Product Image" style="object-fit: cover; height: 300px;">
                            <div class="card-body">
                                <h5 class="card-title p-name" contenteditable><?= $product['name'] ?></h5>
                                <p class="card-text p-price" contenteditable><?= $product['price'] ?>$</p>
                                <p class="card-text p-desc" contenteditable><?= $product['description'] ?></p>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-outline-success btn-upd">Update</button>
                                    <button class="btn btn-outline-danger btn-del">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<script src="../Assets/js/products.js"></script>


<?php
include "footer.php";
?>
