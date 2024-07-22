<?php

namespace App\src;

include('Components/Model/Singleton.php');
include('Components/Router.php');

use App\src\Components\Model\Singleton;
use App\src\Components\Router;

class Kernel extends Singleton
{
    public static function getInstance(): Kernel
    {
        return parent::getInstance();
    }

    public function execute(): void
    {
        $router = Router::getInstance();
        $action = $router->matchAction();

        include('Controller/'.$action->getController().'.php');

        $controllerPath = 'App\\src\\Controller\\'.$action->getController();
        $method = $action->getMethod();

        $controller = new $controllerPath();

        $controller->$method(...($action->getParams()));
    }
}