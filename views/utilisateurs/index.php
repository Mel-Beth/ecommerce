<?php require '../views/layouts/header.php'; ?>

<main class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Gestion des utilisateurs</h2>
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Rôle</th>
                <th class="px-4 py-2">État</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td class="border px-4 py-2"><?= htmlspecialchars($utilisateur['nom']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($utilisateur['email']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($utilisateur['role']) ?></td>
                    <td class="border px-4 py-2"><?= $utilisateur['etat'] ? 'Actif' : 'Inactif' ?></td>
                    <td class="border px-4 py-2">
                        <?php if ($utilisateur['etat']): ?>
                            <a href="desactiver_utilisateur.php?id=<?= $utilisateur['id'] ?>" class="text-red-500">Désactiver</a>
                        <?php else: ?>
                            <a href="activer_utilisateur.php?id=<?= $utilisateur['id'] ?>" class="text-green-500">Activer</a>
                        <?php endif; ?>
                        <a href="supprimer_utilisateur.php?id=<?= $utilisateur['id'] ?>" class="text-red-500 ml-4">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require '../views/layouts/footer.php'; ?>
