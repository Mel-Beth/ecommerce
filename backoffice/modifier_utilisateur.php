<?php
require '../config/db.php';
require '../libs/auth.php';

requireAdmin();

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Utilisateur non spécifié.");
}

// Récupérer les informations de l'utilisateur
$query = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$query->execute([$id]);
$utilisateur = $query->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    die("Utilisateur introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $query = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ?, role = ? WHERE id = ?");
    $query->execute([$nom, $email, $role, $id]);

    header('Location: utilisateurs.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Modifier Utilisateur</h1>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>
        <label>Email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>
        <label>Rôle :</label>
        <select name="role" required>
            <option value="client" <?= $utilisateur['role'] === 'client' ? 'selected' : '' ?>>Client</option>
            <option value="admin" <?= $utilisateur['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
