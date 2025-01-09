<?php
require '../config/db.php';

// Récupérer les commandes
$query = $pdo->query("SELECT * FROM commandes ORDER BY created_at DESC");
$commandes = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Commandes</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Statut</th>
            <th>Total</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $commande) : ?>
            <tr>
                <td><?= $commande['id'] ?></td>
                <td><?= $commande['client'] ?></td>
                <td><?= $commande['statut'] ?></td>
                <td><?= number_format($commande['total'], 2) ?> €</td>
                <td><?= $commande['created_at'] ?></td>
                <td>
                    <form method="POST" action="facture.php">
                        <input type="hidden" name="id" value="<?= $commande['id'] ?>">
                        <button type="submit">Générer PDF</button>
                    </form>
                    <form method="POST" action="update_statut.php">
                        <input type="hidden" name="id" value="<?= $commande['id'] ?>">
                        <select name="statut">
                            <option value="en attente">En attente</option>
                            <option value="validée">Validée</option>
                            <option value="refusée">Refusée</option>
                        </select>
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
