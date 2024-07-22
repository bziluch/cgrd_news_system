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

        if (isset($_POST['title']) && isset($_POST['description'])) {
            $this->articleRepository->addArticle($_POST['title'], $_POST['description']);
            $this->redirect('/');
        }

        $this->renderView('articles/list.twig', [
            'articles' => $articles
        ]);
    }
}