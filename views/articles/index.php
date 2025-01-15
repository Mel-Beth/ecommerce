<?php require 'views/layouts/header.php'; ?>

<main class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6"><i class="fas fa-boxes"></i> Nos produits</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($articles as $article): ?>
            <div class="bg-white shadow-lg rounded-lg p-4">
                <img src="<?= $article['image'] ?? 'https://via.placeholder.com/300' ?>" alt="<?= $article['name'] ?>" class="w-full h-48 object-cover rounded-md">
                <h3 class="text-lg font-bold mt-4"><?= htmlspecialchars($article['name']) ?></h3>
                <p class="text-gray-600"><?= htmlspecialchars($article['category']) ?></p>
                <p class="text-yellow-600 font-bold mt-2"><?= number_format($article['price'], 2) ?> €</p>
                <a href="index.php?controller=articles&action=details&id=<?= $article['id'] ?>" class="block bg-yellow-500 text-white text-center py-2 rounded-md mt-4 hover:bg-yellow-600">
                    <i class="fas fa-eye"></i> Voir le produit
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require 'views/layouts/footer.php'; ?>
