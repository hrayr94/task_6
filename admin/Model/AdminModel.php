<?php
class AdminModel {
    private PDO $connection;

    public function __construct() {
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

    public function getConnection(): PDO {
        return $this->connection;
    }

    public function admin($username, $password)
    {
        $query = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
