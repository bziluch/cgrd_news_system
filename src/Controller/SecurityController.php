<?php

namespace App\src\Controller;

use App\src\Components\AbstractController;

class SecurityController extends AbstractController
{
    public function login() {
        $this->renderView('security/login.twig');
    }
}