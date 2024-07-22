<?php

namespace App\src\Controller;

class DefaultController
{
    public function notFound(): void
    {
        echo 'Page not found!';
        return;
    }

}