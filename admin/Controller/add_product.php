<?php

include "../Model/AdminModel.php";

session_start();

$adminModel = new AdminModel();
$action = $_POST['action'];

if ($action === 'add') {
    $cat_id = $_SESSION['cat_id']; // Ensure cat_id is set correctly
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];

    // Handle image upload
    $img = $_FILES['img']['name'];
    $tmp_img = $_FILES['img']['tmp_name'];
    move_uploaded_file($tmp_img, "../Assets/images/$img");

    // Check if name is not empty before adding
    if (!empty($name)) {
        $adminModel->addProduct($cat_id, $name, $desc, $img, $price);
        header("location: ../View/products.php?cat_id=$cat_id");
    } else {
        // Redirect with error if name is empty
        header("location: ../View/products.php?cat_id=$cat_id&error=empty");
        die;
    }
}

if ($action === 'delete') {
    $id = $_POST['id'];
    $adminModel->deleteProduct($id);
}

if ($action === 'update') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $id = $_POST['id'];
    $adminModel->updateProduct($name, $desc, $price, $id);
}
