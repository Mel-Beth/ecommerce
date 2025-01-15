<?php
require '../config/db.php';
require '../libs/auth.php';

requireAdmin();

$id = $_GET['id'] ?? null;

if ($id) {
    $query = $pdo->prepare("UPDATE utilisateurs SET etat = FALSE WHERE id = ?");
    $query->execute([$id]);
}

header('Location: utilisateurs.php');
exit;
?>
