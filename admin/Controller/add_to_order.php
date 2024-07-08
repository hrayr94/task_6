<?php

use Model\DB;

include "../Model/DB.php";
session_start();

$userModel = new DB();
$action = $_POST['action'];
$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

if ($action === 'add') {
    if (!isset($user_id)) {
        echo json_encode(['success' => false]);
        die;
    }
    $checkCart = $userModel->checkWishSpecificProduct($user_id, $product_id);
    if (!$checkCart) {
        $cartItems = $userModel->addToWish($user_id, $product_id);
        echo json_encode(['success' => true]); //todo make alert for success or not
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'delete') {
    $userModel->deleteFromWish($product_id);
}