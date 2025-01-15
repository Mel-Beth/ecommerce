<?php require 'views/layouts/header.php'; ?>

<main class="container mx-auto p-6">
    <h1 class="text-2xl font-bold">Mon Panier</h1>
    <?php if (empty($articles)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <table class="table-auto w-full mt-6">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= htmlspecialchars($article['name']) ?></td>
                        <td><?= number_format($article['price'], 2) ?> €</td>
                        <td><?= $article['quantity'] ?></td>
                        <td><?= number_format($article['price'] * $article['quantity'], 2) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>

<?php require 'views/layouts/footer.php'; ?>
