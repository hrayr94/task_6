<?php

namespace App\Models;

use PDO;

class AdminModel
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Authenticate admin user.
     *
     * @param string $username
     * @param string $password
     * @return array|false
     */
    public function authenticate($username, $password)
    {
        $query = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
