<?php

namespace App\src\Repository;

include 'src/Components/AbstractRepository.php';

use App\src\Components\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function matchUser(string $login, string $rawPassword): ?array
    {
        $stmt = $this->dbManager->getMysqli()->prepare('SELECT * FROM user WHERE login = ? AND password = MD5(?)');
        $stmt->bind_param('ss', $login, $rawPassword);
        $stmt->execute();
        return $stmt->get_result()?->fetch_assoc();
    }

    public function updateUserSessionKey(string $sessionKey, int $userId): void
    {
        $stmt = $this->dbManager->getMysqli()->prepare('UPDATE user SET session_key = ? WHERE id = ?');
        $stmt->bind_param('si', $sessionKey, $userId);
        $stmt->execute();
    }

    public function getLoggedUser(): ?array
    {
        $stmt = $this->dbManager->getMysqli()->prepare('SELECT * FROM user WHERE session_key = ?');
        $stmt->bind_param('s', $_SESSION['session_key']);
        $stmt->execute();
        return $stmt->get_result()?->fetch_assoc();
    }
}