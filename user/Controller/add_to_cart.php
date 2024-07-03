<?php

include "../Model/UserModel.php";
session_start();

$userModel = new UserModel();
$action = $_POST['action'];
$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

if ($action === 'add') {
    if (!isset($user_id)) {
        echo json_encode(['success' => false]);
        die;
    }
    $checkCart = $userModel->checkCartSpecificProduct($user_id, $product_id);
    if (!$checkCart) {
        $cartItems = $userModel->addToCart($user_id, $product_id, 1);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'update') {
    $quantity = $_POST['quantity'];
    $userModel->updateCart($quantity, $product_id);
}
if ($action === 'delete') {
    $userModel->deleteCart($product_id);
}
