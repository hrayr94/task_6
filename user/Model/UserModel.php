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

    public function checkCartSpecificProduct($user_id, $product_id)
    {
        $query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id, $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function addToCart($user_id, $product_id, $quantity): array
    {
        try {
            $this->createCartItem($user_id, $product_id, $quantity);
            return $this->getAllCartItems($user_id); // Assuming this method exists
        } catch (PDOException $e) {
            // Log or handle the exception
            error_log('Error adding to cart: ' . $e->getMessage());
            return []; // Or return false or an error status based on your application logic
        }
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

    public function checkWishSpecificProduct($user_id, $product_id)
    {
        $query = "SELECT * FROM wish WHERE user_id = ? AND product_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id, $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


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

    public function getAllCartItems($user_id): array
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

    public function addToOrder($user_id)
    {
        // Get cart items
        $cartItems = $this->getAllCartItems($user_id);

        // Calculate total amount
        $total_amount = 0;
        foreach ($cartItems as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

        // Create order and get order ID
        $order_id = $this->createOrder($user_id, $total_amount);

        // Create order items for each cart item
        foreach ($cartItems as $item) {
            $this->createOrderItem($order_id, $item['product_id'], $item['quantity']);
        }

        // Clear cart after order
        $this->clearCart($user_id);

        return $this->getAllOrderItems($order_id); // Return updated order items after placing order
    }


    private function createOrder($user_id, $total_amount)
    {
        $query = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user_id, $total_amount]);
        return $this->connection->lastInsertId();
    }


    public function createOrderItem($order_id, $product_id, $quantity)
    {
        $query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
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
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}