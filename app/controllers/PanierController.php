<?php
require_once 'app/models/Article.php';

class PanierController {
    private $articlesModel;

    public function __construct($pdo) {
        $this->articlesModel = new Article($pdo);
    }

    public function index() {
        $panier = $_SESSION['panier'] ?? [];
        $articles = [];

        foreach ($panier as $id => $quantite) {
            $article = $this->articlesModel->getById($id);
            if ($article) {
                $article['quantite'] = $quantite;
                $articles[] = $article;
            }
        }

        require 'views/panier/index.php';
    }

    public function add() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $_SESSION['panier'][$id] = ($_SESSION['panier'][$id] ?? 0) + 1;
            header('Location: index.php?controller=panier&action=index');
            exit;
        }
    }

    public function remove() {
        $id = $_GET['id'] ?? null;

        if ($id && isset($_SESSION['panier'][$id])) {
            unset($_SESSION['panier'][$id]);
        }

        header('Location: index.php?controller=panier&action=index');
        exit;
    }

    public function clear() {
        unset($_SESSION['panier']);
        header('Location: index.php?controller=panier&action=index');
        exit;
    }
}
?>
