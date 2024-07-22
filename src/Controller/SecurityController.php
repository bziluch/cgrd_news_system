<?php

namespace App\src\Controller;

use App\src\Components\AbstractController;

class SecurityController extends AbstractController
{
    public function login(): void {

        if (null !== $this->getUser()) {
            $this->redirect('/');
        }

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $user = $this->userRepository->matchUser($_POST['login'], $_POST['password']);
            if (null !== $user) {
                $sessionKey = bin2hex(random_bytes(16));
                $this->userRepository->updateUserSessionKey($sessionKey, $user['id']);
                $_SESSION['session_key'] = $sessionKey;
                $this->redirect('/');
            }
            $this->addMessage('error', 'Wrong login data!');
        }

        $this->renderView('security/login.twig');
    }

    public function logout(): void {
        if (null !== $this->getUser()) {
            unset($_SESSION['session_key']);
        }
        $this->redirect('/login');
    }
}