<?php
session_start();

require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/models/Perfume.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/PerfumeController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$controller = $_GET['c'] ?? 'perfume';
$action     = $_GET['a'] ?? 'index';

switch ($controller) {
    case 'auth':
        $ctrl = new AuthController();
        break;
    case 'admin':
        $ctrl = new AdminController();
        break;
    case 'perfume':
    default:
        $ctrl = new PerfumeController();
        break;
}

if (!method_exists($ctrl, $action)) {
    http_response_code(404);
    echo "Página no encontrada";
    exit;
}

$ctrl->$action();
