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
}