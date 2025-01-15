<?php
require_once 'app/models/Commande.php';

class CommandesController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Commande($pdo);
    }

    // Liste des commandes (admin ou client)
    public function index() {
        if (isAdmin()) {
            // Pour admin, toutes les commandes
            $commandes = $this->model->getAll();
        } else {
            // Pour client, commandes de l'utilisateur connecté
            $userId = $_SESSION['user_id'];
            $commandes = $this->model->getByUserId($userId);
        }

        require 'views/commandes/index.php';
    }

    // Générer la facture (admin ou client)
    public function facture() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Commande non spécifiée.");
        }

        $commande = $this->model->getById($id);
        if (!$commande || (!isAdmin() && $commande['user_id'] != $_SESSION['user_id'])) {
            die("Commande introuvable ou accès interdit.");
        }

        require 'views/commandes/facture.php';
    }

    // Valider une commande (admin uniquement)
    public function valider() {
        requireAdmin();

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->updateStatus($id, 'Validée');
        }

        header('Location: index.php?controller=commandes&action=index');
        exit;
    }

    // Rejeter une commande (admin uniquement)
    public function rejeter() {
        requireAdmin();

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->updateStatus($id, 'Rejetée');
        }

        header('Location: index.php?controller=commandes&action=index');
        exit;
    }
}
?>
