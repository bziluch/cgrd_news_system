<?php

namespace App\src\Components;

abstract class AbstractController
{
    public function renderView(string $path, array $params = []) {

        require_once('vendor/autoload.php');

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($path, $params);
    }
}