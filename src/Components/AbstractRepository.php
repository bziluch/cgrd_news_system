<?php

namespace App\src\Components;

include 'DbManager.php';

abstract class AbstractRepository
{
    protected DbManager $dbManager;

    public function __construct() {
        $this->dbManager = DbManager::getInstance();
    }
}