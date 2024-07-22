<?php

namespace App\src\Components;

class DbManager
{
    private \mysqli $mysqli;
    private static ?DbManager $instance = null;

    private static array $config = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'database' => 'cgrd_news_system'
    ];

    private function __construct($host, $user, $password, $database)
    {
        $this->mysqli = new \mysqli($host, $user, $password,$database);
        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
            die();
        }
        $this->mysqli->set_charset('utf8mb4');
    }

    public static function getInstance(): DbManager
    {
        if (self::$instance == null) {
            self::$instance = new DbManager(...self::$config);
        }
        return self::$instance;
    }

    public function getMysqli(): \mysqli
    {
        return $this->mysqli;
    }
}