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

    public function addArticle(string $title, string $description): void
    {
        $stmt = $this->dbManager->getMysqli()->prepare('INSERT INTO article(title, description) VALUES (?,?)');
        $stmt->bind_param('ss', $title, $description);
        $stmt->execute();
    }
}