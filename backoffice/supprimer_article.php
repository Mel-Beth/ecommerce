<?php
require '../config/db.php';
require '../libs/auth.php';

requireAdmin();

$id = $_GET['id'] ?? null;

if ($id) {
    $query = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $query->execute([$id]);
}

header('Location: gestion_articles.php');
exit;
?>
