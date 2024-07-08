<?php

namespace Model;

class OrderModel extends DB
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function getAllCartItems(): array
    {
        $query = "
    SELECT 
        p.name, 
        p.price, 
        p.image, 
        c.quantity, 
        p.description, 
        c.id, 
        c.product_id 
    FROM cart AS c
    JOIN products AS p ON p.id = c.product_id ";
        $stmt = $this->getConnection()->prepare($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToOrder()
    {
        // Get cart items
        $cartItems = $this->getAllCartItems();

        // Calculate total amount
        $total_amount = 0;
        foreach ($cartItems as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

        // Create order and get order ID
        $order_id = $this->createOrder($total_amount);

        // Create order items for each cart item
        foreach ($cartItems as $item) {
            $this->createOrderItem($order_id, $item['product_id'], $item['quantity']);
        }

        // Clear cart after order
        $this->clearCart();

        return $this->getAllOrderItems($order_id); // Return updated order items after placing order
    }


    private function createOrder($total_amount)
    {
        $query = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($total_amount);
        return $this->getConnection()->lastInsertId();
    }


    public function createOrderItem($order_id, $product_id, $quantity)
    {
        $query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute([$order_id, $product_id, $quantity]);
    }

    public function getAllOrderItems($order_id): array
    {
        $query = "
    SELECT 
        p.name, 
        p.price, 
        p.image, 
        p.description, 
        o.id, 
        o.product_id,
        o.quantity
    FROM order_items AS o
    JOIN products AS p ON p.id = o.product_id 
    WHERE order_id = ?";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}