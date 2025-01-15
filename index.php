<?php
session_start();
require 'config/db.php';
require 'libs/auth.php';

require 'app/controllers/ArticlesController.php';
require 'app/controllers/CommandesController.php';
require 'app/controllers/PanierController.php';
require 'app/controllers/UtilisateursController.php';

require 'views/Layouts/head.php';
$controller = $_GET['controller'] ?? 'articles';
$action = $_GET['action'] ?? 'index';

try {
    switch ($controller) {
        case 'articles':
            $controllerInstance = new ArticlesController($pdo);
            break;
        case 'commandes':
            $controllerInstance = new CommandesController($pdo);
            break;
        case 'panier':
            $controllerInstance = new PanierController($pdo);
            break;
        case 'utilisateurs':
            $controllerInstance = new UtilisateursController($pdo);
            break;
        default:
            throw new Exception("Contrôleur inconnu : $controller");
    }

    if (!method_exists($controllerInstance, $action)) {
        throw new Exception("Action inconnue : $action");
    }

    $controllerInstance->$action();
} catch (Exception $e) {
    http_response_code(404);
    echo "<h1>Erreur 404</h1>";
    echo "<p>{$e->getMessage()}</p>";
}
?>
