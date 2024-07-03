<?php
session_start();
include "../Model/UserModel.php";

$userModel = new UserModel();

// Initialize variables with default values to avoid notices
$action = $_POST['action'] ?? '';
$user_id = $_SESSION['user_id'] ?? null;
$product_id = $_POST['product_id'] ?? null;

if ($action === 'add') {
    if (!isset($user_id)) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        die;
    }

    $checkCart = $userModel->checkCartSpecificProduct($user_id, $product_id);

    if (!$checkCart) {
        $cartItems = $userModel->addToCart($user_id, $product_id, 1);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product already in cart']);
    }
} elseif ($action === 'update') {
    $quantity = $_POST['quantity'] ?? 0;
    $userModel->updateCart($quantity, $product_id);
} elseif ($action === 'delete') {
    $userModel->deleteCart($product_id);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
