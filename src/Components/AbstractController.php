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

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
        }
    }

    public function renderView(string $path, array $params = []) {

        require_once('vendor/autoload.php');

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($path, array_merge($params, $this->getGlobalTwigParams()));
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

    public function addMessage(string $type, string $content): void
    {
        if (!isset($_SESSION['popup-messages']) || gettype($_SESSION['popup-messages']) !== 'array') {
            $_SESSION['popup-messages'] = [];
        }
        $_SESSION['popup-messages'][] = ['type' => $type, 'content' => $content];
    }

    public function isValidFormCsrfToken(): bool
    {
        if (isset($_POST['token']) && $_POST['token'] === $_SESSION['csrf_token']) {
            return true;
        }

        $this->addMessage('error', 'Invalid CSRF token!');
        return false;
    }

    private function getMessages(): array
    {
        if ($this->isXmlHttpRequest()) {
            return [];
        }

        $messages = $_SESSION['popup-messages'] ?? [];
        unset($_SESSION['popup-messages']);
        return $messages;
    }

    private function getGlobalTwigParams(): array
    {
        return [
            'messages' => $this->getMessages(),
            'token' => $_SESSION['csrf_token']
        ];
    }
}