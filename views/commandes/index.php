<?php require 'views/layouts/header.php'; ?>

<main class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Mes Commandes</h2>
    <?php if (empty($commandes)): ?>
        <p>Vous n'avez pas encore passé de commande.</p>
    <?php else: ?>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">N° Commande</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Montant</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($commande['id']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($commande['created_at']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($commande['status']) ?></td>
                        <td class="border px-4 py-2"><?= number_format($commande['total_price'], 2) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>

<?php require 'views/layouts/footer.php'; ?>
