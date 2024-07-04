<?php
require_once '../Model/ProductModel.php';

session_start();

$adminModel = new AdminModel();
$pdo = $adminModel->getConnection();
$productModel = new ProductModel($pdo);
$action = $_POST['action'];

if ($action === 'add') {
    $cat_id = $_SESSION['cat_id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];

    $img = $_FILES['img']['name'];
    $tmp_img = $_FILES['img']['tmp_name'];
    move_uploaded_file($tmp_img, "../Assets/images/$img");

    if (!empty($name)) {
        $productModel->addProduct($cat_id, $name, $desc, $img, $price);
        header("location: ../View/products.php?cat_id=$cat_id");
    } else {
        header("location: ../View/products.php?cat_id=$cat_id&error=empty");
        die;
    }
}

if ($action === 'delete') {
    $id = $_POST['id'];
    $productModel->deleteProduct($id);
}

if ($action === 'update') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $id = $_POST['id'];
    $productModel->updateProduct($name, $desc, $price, $id);
}
