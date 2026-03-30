<?php
session_start();
require_once 'config/database.php';
require_once 'models/User.php';
require_once 'models/Unit.php';
require_once 'models/Composition.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/UnitController.php';
require_once 'controllers/CompositionController.php';

$page = $_GET['page'] ?? 'home';

$userModel = new User($pdo);
$unitModel = new Unit($pdo);
$compositionModel = new Composition($pdo);

switch ($page) {
    case 'login':
        $authController = new AuthController($userModel);
        $authController->login();
        break;
    case 'register':
        $authController = new AuthController($userModel);
        $authController->register();
        break;
    case 'logout':
        $authController = new AuthController($userModel);
        $authController->logout();
        break;
    case 'profile':
        $homeController = new HomeController($userModel, $compositionModel);
        $homeController->profile();
        break;
    case 'delete_account':
        $homeController = new HomeController($userModel, $compositionModel);
        $homeController->deleteAccount();
        break;
    case 'units':
        $unitController = new UnitController($unitModel);
        $unitController->list();
        break;
    case 'units_create':
        $unitController = new UnitController($unitModel);
        $unitController->create();
        break;
    case 'units_edit':
        $unitController = new UnitController($unitModel);
        $unitController->edit();
        break;
    case 'units_delete':
        $unitController = new UnitController($unitModel);
        $unitController->delete();
        break;
    case 'compositions':
        $compositionController = new CompositionController($compositionModel, $unitModel);
        $compositionController->list();
        break;
    case 'compositions_create':
        $compositionController = new CompositionController($compositionModel, $unitModel);
        $compositionController->create();
        break;
    case 'compositions_detail':
        $compositionController = new CompositionController($compositionModel, $unitModel);
        $compositionController->detail();
        break;
    case 'compositions_edit':
        $compositionController = new CompositionController($compositionModel, $unitModel);
        $compositionController->edit();
        break;
    case 'compositions_delete':
        $compositionController = new CompositionController($compositionModel, $unitModel);
        $compositionController->delete();
        break;
    case 'public_compositions':
        $compositionController = new CompositionController($compositionModel, $unitModel);
        $compositionController->publicList();
        break;
    case 'public_compositions_detail':
        $compositionController = new CompositionController($compositionModel, $unitModel);
        $compositionController->publicDetail();
        break;
    default:
        $homeController = new HomeController($userModel, $compositionModel);
        $homeController->index();
}
?>