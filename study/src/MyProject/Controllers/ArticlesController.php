<?php

namespace MyProject\Controllers;


use MyProject\Models\Users\User;
use MyProject\Models\Articles\Article;
use MyProject\View\View;

class ArticlesController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }

    public function create(): void
    {
        $article2 = new Article();
        $article2->setName('Новая статья 2');
        $article2->setText('Новый текст 2');
        $article2->setAuthorId(1);
        $article2->save();
    }

    public function add(): void{
        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }
            header('Location: ' . $article->getId(), true, 302);
            exit();
        }
        $this->view->renderHtml('articles/add.php');
    }

    public function delete(int $articleId): void{
        $article = Article::getById($articleId);
        if ($article === null) {
            $this->view->renderHtml('errors/notObject.php', [], 404);
            return;
        }
        $article->delete();
    }

    public function edit(int $articleId){
        $article = Article::getById($articleId);
    
        if ($article === null) {
            throw new NotFoundException();
        }
        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }
            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }
        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }
}