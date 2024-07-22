<?php

namespace App\src\Controller;

use App\src\Components\AbstractController;

abstract class SecureController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
        if (null === $this->getUser()) {
            $this->redirect('/login');
        }
    }

}