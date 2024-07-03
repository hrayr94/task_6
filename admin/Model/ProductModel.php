<?php

namespace App\Models;

use PDO;

class ProductModel
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Add a new product.
     *
     * @param int $category_id
     * @param string $name
     * @param string $description
     * @param string $image
     * @param float $price
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
     * Get products by category ID.
     *
     * @param int $category_id
     * @return array
     */
    public function getProductsByCategoryId($category_id): array
    {
        $query = "SELECT * FROM products WHERE category_id = :category_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update a product.
     *
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $id
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
     * Delete a product.
     *
     * @param int $id
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
