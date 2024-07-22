<?php

namespace App\src\Controller;

use App\src\Components\AbstractController;

class DefaultController extends AbstractController
{
    public function notFound(): void
    {
        $this->renderView('not_found.twig');
    }

}