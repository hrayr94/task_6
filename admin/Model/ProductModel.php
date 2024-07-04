<?php
require_once 'AdminModel.php';

class ProductModel extends AdminModel
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

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
        $stmt = $this->getConnection()->prepare($query);
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
    public function getProductsByCategory($category_id): array
    {
        $query = "SELECT * FROM products WHERE category_id = :category_id";
        $stmt = $this->getConnection()->prepare($query);
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
        $stmt = $this->getConnection()->prepare($query);
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
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
