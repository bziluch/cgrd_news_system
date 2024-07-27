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

    public function renderIndex(string $path, array $params = [])
    {
        $this->renderView($path, array_merge(
            $params,
            ['articles' => $this->articleRepository->findAll()]
        ));
    }

    public function list()
    {
        if (isset($_POST['title']) && isset($_POST['description']) && $this->isValidFormCsrfToken()) {
            if ($this->articleRepository->add($_POST['title'], $_POST['description'])) {
                $this->addMessage('success', 'News was successfully created!');
            } else {
                $this->addMessage('error', 'News creating operation failed!');
            }
            $this->redirect('/');
        }

        $this->renderIndex('articles/list.twig', [
            'isXmlHttpRequest' => $this->isXmlHttpRequest()
        ]);
    }

    public function edit(int $id): void
    {
        $article = $this->articleRepository->find($id);

        if (isset($_POST['title']) && isset($_POST['description']) && $this->isValidFormCsrfToken()) {
            if ($this->articleRepository->update($id, $_POST['title'], $_POST['description'])) {
                $this->addMessage('success', 'News was successfully changed!');
            } else {
                $this->addMessage('error', 'News update operation failed!');
            }
            $this->redirect('/');
        }

        $this->renderIndex('articles/edit.twig', [
            'article' => $article,
            'isXmlHttpRequest' => $this->isXmlHttpRequest()
        ]);
    }

    public function delete(int $id): void
    {
        if (null !== $this->articleRepository->find($id)) {
            if ($this->articleRepository->remove($id)) {
                $this->addMessage('success', 'News was successfully deleted!');
            } else {
                $this->addMessage('error', 'News deleting operation failed!');
            }
        }
        $this->redirect('/');
    }
}