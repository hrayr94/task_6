<?php

class AdminModel
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
            die('Connection failed: ' . $e->getMessage());
        }
    }

    // login

    /**
     * @param $username
     * @param $password
     * @return array|false
     */
    public function admin($username, $password)
    {
        $query = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // categories

    /**
     * @param $name
     * @return void
     */
    public function addCategories($name): void
    {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $name
     * @param $id
     * @return void
     */
    public function updateCategories($name, $id): void
    {
        $query = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteCategories($id): void
    {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // products

    /**
     * @param $category_id
     * @param $name
     * @param $description
     * @param $image
     * @param $price
     * @return void
     */
    public function addProduct($category_id, $name, $description, $image, $price): void
    {
        $query = "INSERT INTO products (category_id, name, description, image, price) VALUES (:category_id, :name, :description, :image, :price)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
    }

    /**
     * @param $category_id
     * @return array
     */
    public function getProduct($category_id): array
    {
        $query = "SELECT * FROM products WHERE category_id = :category_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $name
     * @param $description
     * @param $price
     * @param $id
     * @return void
     */
    public function updateProduct($name, $description, $price, $id): void
    {
        $query = "UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteProduct($id): void
    {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

