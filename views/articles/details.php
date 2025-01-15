<?php require 'views/layouts/header.php'; ?>

<main class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6"><?= htmlspecialchars($article['name']) ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <img src="<?= $article['image'] ?? 'https://via.placeholder.com/300' ?>" alt="<?= htmlspecialchars($article['name']) ?>" class="rounded-lg shadow-lg">
        <div>
            <p class="text-gray-600"><?= htmlspecialchars($article['description']) ?></p>
            <p class="text-yellow-600 font-bold mt-4"><?= number_format($article['price'], 2) ?> €</p>
            <a href="index.php?controller=panier&action=add&id=<?= $article['id'] ?>" class="block bg-yellow-500 text-white text-center py-2 rounded-md mt-4 hover:bg-yellow-600">
                <i class="fas fa-cart-plus"></i> Ajouter au panier
            </a>
        </div>
    </div>
</main>

<?php require 'views/layouts/footer.php'; ?>
