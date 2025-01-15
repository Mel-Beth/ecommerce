<?php require 'views/layouts/header.php'; ?>

<main class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6"><i class="fas fa-file-invoice"></i> Facture de la commande</h2>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4">Commande n°<?= htmlspecialchars($commande['id']) ?></h3>
        <p>Date : <?= htmlspecialchars($commande['created_at']) ?></p>
        <p>Total : <?= number_format($commande['total_price'], 2) ?> €</p>
        <p>Statut : <?= htmlspecialchars($commande['status']) ?></p>

        <h4 class="text-md font-bold mt-6">Détails des articles</h4>
        <ul class="list-disc ml-6 mt-2">
            <?php foreach (json_decode($commande['items'], true) as $item): ?>
                <li><?= htmlspecialchars($item['name']) ?> - Quantité : <?= $item['quantity'] ?> - Prix : <?= number_format($item['price'], 2) ?> €</li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php require 'views/layouts/footer.php'; ?>
