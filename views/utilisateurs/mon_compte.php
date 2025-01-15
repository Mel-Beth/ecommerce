<?php
require 'config/db.php';
require 'libs/auth.php';

requireAuth();

$userId = $_SESSION['user_id'];
$query = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$query->execute([$userId]);
$utilisateur = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $query = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ?, password = ? WHERE id = ?");
        $query->execute([$nom, $email, $passwordHash, $userId]);
    } else {
        $query = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ? WHERE id = ?");
        $query->execute([$nom, $email, $userId]);
    }

    $message = "Vos informations ont été mises à jour avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Mon Compte</h1>
    <?php if (!empty($message)): ?>
        <p class="success-message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>
        <label>Email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>
        <label>Mot de passe :</label>
        <input type="password" name="password" placeholder="Laisser vide pour conserver l'ancien mot de passe">
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
