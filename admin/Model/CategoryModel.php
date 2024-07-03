<?php

namespace App\Models;

use PDO;

class CategoryModel
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Add a new category.
     *
     * @param string $name
     * @return void
     */
    public function addCategory($name): void
    {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    /**
     * Get all categories.
     *
     * @return array
     */
    public function getCategories(): array
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update a category.
     *
     * @param string $name
     * @param int $id
     * @return void
     */
    public function updateCategory($name, $id): void
    {
        $query = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * Delete a category.
     *
     * @param int $id
     * @return void
     */
    public function deleteCategory($id): void
    {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
