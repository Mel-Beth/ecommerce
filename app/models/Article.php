<?php
class Article {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $query = $this->pdo->query("SELECT * FROM articles");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
