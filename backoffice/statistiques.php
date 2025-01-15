<?php
require '../config/db.php';
require '../libs/auth.php';

requireAdmin();

// Récupération des données
$totalCommandes = $pdo->query("SELECT COUNT(*) FROM commandes")->fetchColumn();
$totalUtilisateurs = $pdo->query("SELECT COUNT(*) FROM utilisateurs")->fetchColumn();
$totalArticles = $pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn();
$revenus = $pdo->query("SELECT SUM(total_price) FROM commandes WHERE status = 'Validée'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques - Backoffice</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Statistiques</h1>
    <div class="stats-grid">
        <div class="stat-item">
            <h2>Total Commandes</h2>
            <p><?= $totalCommandes ?></p>
        </div>
        <div class="stat-item">
            <h2>Total Utilisateurs</h2>
            <p><?= $totalUtilisateurs ?></p>
        </div>
        <div class="stat-item">
            <h2>Total Articles</h2>
            <p><?= $totalArticles ?></p>
        </div>
        <div class="stat-item">
            <h2>Revenus Totaux</h2>
            <p><?= number_format($revenus, 2) ?> €</p>
        </div>
    </div>

    <canvas id="commandesChart"></canvas>
    <script>
        // Exemple de graphique avec Chart.js
        const ctx = document.getElementById('commandesChart').getContext('2d');
        const commandesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Commandes par mois',
                    data: [12, 19, 3, 5, 2], // Remplacez avec vos données
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
