<?php
require '../config/db.php';
require '../libs/auth.php';

requireAdmin();

$query = $pdo->query("SELECT * FROM articles");
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    if ($id) {
        $query = $pdo->prepare("UPDATE articles SET name = ?, price = ?, description = ?, category = ? WHERE id = ?");
        $query->execute([$name, $price, $description, $category, $id]);
    } else {
        $query = $pdo->prepare("INSERT INTO articles (name, price, description, category) VALUES (?, ?, ?, ?)");
        $query->execute([$name, $price, $description, $category]);
    }

    header('Location: gestion_articles.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des articles</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Gestion des articles</h1>
    <form method="POST">
        <input type="hidden" name="id" id="id">
        <input type="text" name="name" placeholder="Nom de l'article">
        <input type="number" name="price" placeholder="Prix">
        <textarea name="description" placeholder="Description"></textarea>
        <input type="text" name="category" placeholder="Catégorie">
        <button type="submit">Enregistrer</button>
    </form>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <?= htmlspecialchars($article['name']) ?> - <?= htmlspecialchars($article['price']) ?> €
                <a href="edit.php?id=<?= $article['id'] ?>">Modifier</a>
                <a href="delete.php?id=<?= $article['id'] ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
