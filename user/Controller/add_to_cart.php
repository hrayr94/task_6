<?php
require_once "../Model/CartModel.php";

session_start();

$response = ['success' => false, 'message' => 'Error adding to cart'];
$quantity = 0;
if (isset($_POST['product_id']) && isset($_POST['action']) && $_POST['action'] === 'add') {
    $product_id = $_POST['product_id'];
    $quantity += 1;

    $cartModel = new CartModel();
    $cartItems = $cartModel->addToCart($product_id, $quantity);

    if (!empty($cartItems)) {
        $response['success'] = true;
        $response['message'] = 'Product added to cart successfully';
        $response['cart'] = $cartItems;
    }
}

echo json_encode($response);
?>
