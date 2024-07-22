<?php

namespace App\src\Components;

include_once 'DbManager.php';

abstract class AbstractRepository
{
    protected DbManager $dbManager;

    public function __construct() {
        $this->dbManager = DbManager::getInstance();
    }
}