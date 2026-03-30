<?php
class HomeController {
    private $userModel;
    private $compositionModel;

    public function __construct($userModel = null, $compositionModel = null) {
        $this->userModel = $userModel;
        $this->compositionModel = $compositionModel;
    }

    public function index() {
        $isLoggedIn = isset($_SESSION['user_id']);
        include 'views/home.php';
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $publicCount = $this->compositionModel->countPublicCompositionsByUser($_SESSION['user_id']);
        $privateCount = $this->compositionModel->countPrivateCompositionsByUser($_SESSION['user_id']);

        include 'views/profile.php';
    }

    public function deleteAccount() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        // La cascade DELETE dans la BDD supprime automatiquement :
        // - Les compositions de l'user
        // - Les composition_units associées
        $this->userModel->deleteUser($_SESSION['user_id']);

        // Détruire la session
        session_destroy();

        // Rediriger vers l'accueil
        header('Location: index.php');
        exit;
    }
}
?>