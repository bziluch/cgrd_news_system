<?php

namespace App\src\Components\Model;

class Singleton
{

    private static array $instances = [];
    protected function __construct() { }
    protected function __clone() { }

    public static function getInstance(): Singleton
    {
        $router = static::class;
        if (!isset(self::$instances[$router])) {
            self::$instances[$router] = new static();
        }

        return self::$instances[$router];
    }
}