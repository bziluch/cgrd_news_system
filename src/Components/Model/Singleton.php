<?php

namespace App\src\Components\Model;

class Singleton
{

    private static array $instances = [];
    protected function __construct() { }
    protected function __clone() { }

    public static function getInstance(): Singleton
    {
        $obj = static::class;
        if (!isset(self::$instances[$obj])) {
            self::$instances[$obj] = new static();
        }

        return self::$instances[$obj];
    }
}