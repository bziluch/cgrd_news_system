<?php

namespace App\src\Repository;

use App\src\Components\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function matchUser(string $login, string $rawPassword)
    {
        $stmt = $this->dbManager->getMysqli()->prepare('SELECT * FROM user WHERE username = ? AND password = MD5(?)');
        $stmt->bind_param('ss', $login, $rawPassword);
        $stmt->execute();
    }
}