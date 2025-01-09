<?php
require 'config/db.php';

// Charger les articles depuis la base de données
$query = $pdo->query("SELECT * FROM articles");
$articles = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - E-commerce</title>
    <!-- Styles TailwindCSS et FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-yellow-500 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                <i class="fas fa-store"></i> Vide Ton Porte-Monnaie
            </h1>
            <nav>
                <a href="index.php" class="px-4 hover:underline">
                    <i class="fas fa-home"></i> Accueil
                </a>
                <a href="panier.php" class="px-4 hover:underline">
                    <i class="fas fa-shopping-cart"></i> Panier
                </a>
                <a href="contact.php" class="px-4 hover:underline">
                    <i class="fas fa-envelope"></i> Contact
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-yellow-300 text-center py-12">
        <h2 class="text-3xl font-bold">
            <i class="fas fa-star"></i> Bienvenue sur notre boutique en ligne
        </h2>
        <p class="mt-4 text-lg">Découvrez nos meilleurs produits et faites votre choix dès aujourd'hui !</p>
    </section>

    <!-- Produits -->
    <main class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">
            <i class="fas fa-boxes"></i> Nos produits
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($articles as $article): ?>
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <!-- Image du produit -->
                    <img src="<?= $article['image'] ?? 'https://via.placeholder.com/300' ?>" alt="<?= $article['name'] ?>" class="w-full h-48 object-cover rounded-md">
                    
                    <!-- Informations du produit -->
                    <h3 class="text-lg font-bold mt-4">
                        <i class="fas fa-tag"></i> <?= htmlspecialchars($article['name']) ?>
                    </h3>
                    <p class="text-gray-600">
                        <i class="fas fa-list-alt"></i> <?= htmlspecialchars($article['category']) ?>
                    </p>
                    <p class="text-yellow-600 font-bold mt-2">
                        <i class="fas fa-euro-sign"></i> <?= number_format($article['price'], 2) ?> €
                    </p>

                    <!-- Bouton -->
                    <a href="article.php?id=<?= $article['id'] ?>" class="block bg-yellow-500 text-white text-center py-2 rounded-md mt-4 hover:bg-yellow-600">
                        <i class="fas fa-eye"></i> Voir le produit
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-6">
        <div class="container mx-auto text-center">
            <p>
                &copy; <?= date('Y') ?> Mon E-commerce. Tous droits réservés.
                <i class="fas fa-heart"></i>
            </p>
        </div>
    </footer>
</body>
</html>
