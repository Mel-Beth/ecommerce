<?php
class DashboardController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        // Charger les données pour les statistiques
        $totalCommandes = $this->pdo->query("SELECT COUNT(*) FROM commandes")->fetchColumn();
        $totalUtilisateurs = $this->pdo->query("SELECT COUNT(*) FROM utilisateurs")->fetchColumn();
        $totalArticles = $this->pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn();

        // Passer les données à la vue
        require '../views/dashboard/index.php';
    }
}
?>
