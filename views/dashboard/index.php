<?php require '../views/layouts/header.php'; ?>

<main class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Tableau de bord</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-xl font-bold">Total des commandes</h2>
            <p class="text-gray-700 text-4xl mt-4"><?= htmlspecialchars($totalCommandes) ?></p>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-xl font-bold">Total des utilisateurs</h2>
            <p class="text-gray-700 text-4xl mt-4"><?= htmlspecialchars($totalUtilisateurs) ?></p>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-xl font-bold">Total des articles</h2>
            <p class="text-gray-700 text-4xl mt-4"><?= htmlspecialchars($totalArticles) ?></p>
        </div>
    </div>

    <div class="mt-8">
        <a href="index.php?controller=articles&action=index" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Gestion des articles</a>
        <a href="index.php?controller=utilisateurs&action=index" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 ml-4">Gestion des utilisateurs</a>
        <a href="index.php?controller=commandes&action=index" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 ml-4">Gestion des commandes</a>
    </div>
</main>

<?php require '../views/layouts/footer.php'; ?>
