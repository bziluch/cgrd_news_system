<?php

namespace App\src\Controller;

include_once 'src/Repository/ArticleRepository.php';
include_once 'src/Controller/SecureController.php';

use App\src\Repository\ArticleRepository;

class ArticleController extends SecureController
{
    private ArticleRepository $articleRepository;

    public function __construct()
    {
        parent::__construct();
        $this->articleRepository = new ArticleRepository();
    }

    public function list()
    {
        $articles = $this->articleRepository->findAll();
        $this->renderView('articles/list.twig', [
            'articles' => $articles
        ]);
    }
}