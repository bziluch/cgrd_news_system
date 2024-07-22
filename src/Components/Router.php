<?php

namespace App\src\Components;

include('Model/MatchedAction.php');

use App\src\Components\Model\MatchedAction;
use App\src\Components\Model\Singleton;

class Router extends Singleton
{
    public static function getInstance(): Router
    {
        return parent::getInstance();
    }

    /** @return array<string> */
    public function getPath(): array {
        $path = explode('/', $_SERVER['REQUEST_URI']);

        echo '<pre>';
        var_dump($path);
        echo '</pre>';

        if ($path[0] == '' && isset($path[1])) {
            array_shift($path);
        }
        return $path;

    }

    public function matchAction(): MatchedAction
    {
        $path = self::getPath();
        return match ($path[0]) {
            default => (new MatchedAction('DefaultController', 'notFound', []))
        };
    }

}