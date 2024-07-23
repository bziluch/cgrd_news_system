<?php

namespace App\src\Repository;

include_once 'src/Components/AbstractRepository.php';

use App\src\Components\AbstractRepository;

class ArticleRepository extends AbstractRepository
{
    public function findAll(): array
    {
        $stmt = $this->dbManager->getMysqli()->prepare('SELECT * FROM article');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function add(string $title, string $description): bool
    {
        $stmt = $this->dbManager->getMysqli()->prepare('INSERT INTO article(title, description) VALUES (?,?)');
        $stmt->bind_param('ss', $title, $description);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->dbManager->getMysqli()->prepare('SELECT * FROM article WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()?->fetch_assoc();
    }

    public function update(int $id, string $title, string $description): bool
    {
        $stmt = $this->dbManager->getMysqli()->prepare('UPDATE article SET title = ?, description = ? WHERE id = ?');
        $stmt->bind_param('ssi', $title, $description, $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function remove(int $id): bool
    {
        $stmt = $this->dbManager->getMysqli()->prepare('DELETE FROM article WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }
}