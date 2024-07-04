<?php
require_once 'AdminModel.php';

class ProductModel extends AdminModel
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * @param $name
     * @param $description
     * @param $image
     * @param $price
     * @return void
     */
    public function addProduct($name, $description, $image, $price): void
    {
        $query = "INSERT INTO products (name, description, image, price) VALUES (:name, :description, :image, :price)";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        $query = "SELECT * FROM products";
        $stmt = $this->getConnection()->prepare($query);
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
