<?php

require_once "UserModel.php";

class ProductModel extends UserModel
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }


    // Products Methods

    public function getProducts(): array
    {
        $query = "SELECT * FROM products";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}