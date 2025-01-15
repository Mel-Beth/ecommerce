<?php
require '../config/db.php';
require '../libs/auth.php';

requireAdmin();

// Définir les contrôleurs et les actions disponibles
$controller = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

// Charger le bon contrôleur
try {
    switch ($controller) {
        case 'dashboard':
            require '../app/controllers/DashboardController.php';
            $controllerInstance = new DashboardController($pdo);
            break;
        case 'articles':
            require '../app/controllers/ArticlesController.php';
            $controllerInstance = new ArticlesController($pdo);
            break;
        case 'utilisateurs':
            require '../app/controllers/UtilisateursController.php';
            $controllerInstance = new UtilisateursController($pdo);
            break;
        case 'commandes':
            require '../app/controllers/CommandesController.php';
            $controllerInstance = new CommandesController($pdo);
            break;
        default:
            throw new Exception("Contrôleur inconnu : $controller");
    }

    if (!method_exists($controllerInstance, $action)) {
        throw new Exception("Action inconnue : $action");
    }

    // Appeler l'action
    $controllerInstance->$action();
} catch (Exception $e) {
    http_response_code(404);
    echo "<h1>Erreur 404</h1>";
    echo "<p>{$e->getMessage()}</p>";
}
?>
