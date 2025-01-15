<?php
class Commande {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer toutes les commandes
    public function getAll() {
        $query = $this->pdo->query("SELECT * FROM commandes");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les commandes par utilisateur
    public function getByUserId($userId) {
        $query = $this->pdo->prepare("SELECT * FROM commandes WHERE user_id = ?");
        $query->execute([$userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une commande par son ID
    public function getById($id) {
        $query = $this->pdo->prepare("SELECT * FROM commandes WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour le statut d'une commande
    public function updateStatus($id, $status) {
        $query = $this->pdo->prepare("UPDATE commandes SET status = ? WHERE id = ?");
        $query->execute([$status, $id]);
    }
}
?>
