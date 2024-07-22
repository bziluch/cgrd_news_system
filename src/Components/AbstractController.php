<?php

namespace App\src\Components;

include_once "src/Repository/UserRepository.php";

use App\src\Repository\UserRepository;
use JetBrains\PhpStorm\NoReturn;

abstract class AbstractController
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        session_start();
    }

    public function renderView(string $path, array $params = []) {

        require_once('vendor/autoload.php');

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($path, $params);
    }

    public function getUser(): ?array
    {
        if (isset($_SESSION['session_key'])) {
            return $this->userRepository->getLoggedUser();
        }
        return null;
    }

    #[NoReturn] public function redirect(string $path)
    {
        $path =  (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://".$_SERVER["HTTP_HOST"].$path;
        header("Location: ".$path);
        die();
    }

    public function isXmlHttpRequest(): bool
    {
        return isset($_SERVER['HTTP_X_XHR_REQUEST']) && strtolower($_SERVER['HTTP_X_XHR_REQUEST']) === 'xmlhttprequest';
    }
}