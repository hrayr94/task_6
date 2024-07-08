<?php

namespace Model;
class CartModel
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function checkCartSpecificProduct($product_id)
    {
        foreach ($_SESSION['cart'] as $item) {
            if ($item['product_id'] == $product_id) {
                return $item;
            }
        }
        return false;
    }

    public function addToCart($product_id, $quantity = 1): array
    {
        try {
            if ($this->checkCartSpecificProduct($product_id)) {
                $this->updateCart($quantity, $product_id);
            } else {
                $this->createCartItem($product_id, $quantity);
            }
            return $_SESSION['cart'];
        } catch (Exception $e) {
            error_log('Error adding to cart: ' . $e->getMessage());
            return [];
        }
    }

    public function createCartItem($product_id, $quantity): void
    {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'quantity' => $quantity
        ];
    }

    public function getCartItems(): array
    {
        return $_SESSION['cart'];
    }

    public function clearCart(): void
    {
        $_SESSION['cart'] = [];
    }

    public function updateCart($quantity, $product_id): void
    {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
    }

    public function deleteCart($product_id): void
    {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}
