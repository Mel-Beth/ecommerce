<?php
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $query = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (?, ?, ?)");
        $query->execute([$nom, $email, $hashedPassword]);

        header('Location: login.php?success=registered');
        exit;
    } catch (PDOException $e) {
        $error = "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-16 max-w-md">
        <h1 class="text-3xl font-bold text-center mb-6">Inscription</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500 text-center mb-4"><?= $error ?></p>
        <?php endif; ?>
        <form action="register.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-bold">Nom</label>
                <input type="text" name="nom" id="nom" required class="w-full mt-2 p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold">Email</label>
                <input type="email" name="email" id="email" required class="w-full mt-2 p-2 border rounded">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold">Mot de passe</label>
                <input type="password" name="password" id="password" required class="w-full mt-2 p-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">
                S'inscrire
            </button>
        </form>
    </div>
</body>
</html>
