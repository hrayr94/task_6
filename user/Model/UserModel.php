<?php

class UserModel
{
    private PDO $connection;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=online_shop';
        $username = 'root';
        $password = '';

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // User Methods

    public function addUser($name, $login, $pass, $email): void
    {
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT); // Hash password
        $query = "INSERT INTO users VALUES (null, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$name, $login, $hashedPass, $email]);
    }

    public function checkUser($email, $pass): ?array
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user['password'])) {
            return $user;
        }

        return null;
    }



    // Categories Methods

    public function getCategories(): array
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Products Methods

    public function getProducts($cat_id): array
    {
        $query = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$cat_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cart Methods

    public function addToCart($user_id, $product_id, $quantity): array
    {
        $this->createCartItem($user_id, $product_id, $quantity);
        return $this->getAllCartItems($user_id);
    }

    public function createCartItem($user_id, $product_id, $quantity): void
    {
        $query = "INSERT INTO cart VALUES (null, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id, $product_id, $quantity]);
    }

    public function getCartItems($user_id): array
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
        JOIN products AS p ON p.id = c.product_id 
        WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clearCart($user_id): void
    {
        $query = "DELETE FROM cart WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id]);
    }

    public function updateCart($quantity, $product_id): void
    {
        $query = "UPDATE cart SET quantity = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$quantity, $product_id]);
    }

    public function deleteCart($product_id): void
    {
        $query = "DELETE FROM cart WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$product_id]);
    }

    // Wish Methods

    public function addToWish($user_id, $product_id): array
    {
        $this->createWishItem($user_id, $product_id);
        return $this->getAllWishItems($user_id);
    }

    public function createWishItem($user_id, $product_id): void
    {
        $query = "INSERT INTO wish VALUES (null, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id, $product_id]);
    }

    public function getWishItems($user_id): array
    {
        $query = "
        SELECT 
            p.name, 
            p.price, 
            p.image, 
            p.description, 
            w.id, 
            w.product_id 
        FROM wish AS w
        JOIN products AS p ON p.id = w.product_id 
        WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteFromWish($id): void
    {
        $query = "DELETE FROM wish WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
    }

    // Order Methods

    public function addToOrder($user_id): array
    {
        $cartItems = $this->getCartItems($user_id);

        // Create order items for each cart item
        foreach ($cartItems as $item) {
            $this->createOrderItem($user_id, $item['product_id'], $item['quantity']);
        }

        // Clear cart after order
        $this->clearCart($user_id);

        return $this->getAllCartItems($user_id); // Assuming you want to return updated cart items after placing order
    }

    public function createOrderItem($user_id, $product_id, $quantity): void
    {
        $query = "INSERT INTO order_items VALUES (null, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id, $product_id, $quantity]);
    }

    public function getOrderItems($order_id): array
    {
        $query = "SELECT * FROM order_items WHERE order_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

