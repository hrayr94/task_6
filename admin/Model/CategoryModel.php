<?php
require_once 'AdminModel.php';

class CategoryModel extends AdminModel
{
    public function __construct(PDO $pdo)
    {
        parent::__construct();
    }

    public function addCategory($name): void
    {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function getCategories(): array
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCategory($name, $id): void
    {
        $query = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteCategory($id): void
    {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
