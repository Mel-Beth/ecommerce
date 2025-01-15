<?php
require_once 'app/models/Article.php';

class ArticlesController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Article($pdo);
    }

    public function index() {
        $articles = $this->model->getAll();
        require 'views/articles/index.php';
    }

    public function details() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Article non spécifié.");
        }

        $article = $this->model->getById($id);
        if (!$article) {
            die("Article introuvable.");
        }

        require 'views/articles/details.php';
    }
}
?>
