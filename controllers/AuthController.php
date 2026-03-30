<?php
class AuthController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->getUserByUsername($username);

            if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: index.php');
                exit;
            } else {
                $error = 'Identifiants incorrects';
            }
        }

        include 'views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if (empty($username) || empty($password)) {
                $error = 'Veuillez remplir tous les champs';
            } elseif (strlen($username) < 3) {
                $error = 'Le nom d\'utilisateur doit avoir au moins 3 caractères';
            } elseif ($password !== $password_confirm) {
                $error = 'Les mots de passe ne correspondent pas';
            } elseif (!$this->userModel->validatePassword($password)) {
                $error = 'Le mot de passe ne respecte pas les critères de sécurité';
            } else {
                $result = $this->userModel->createUser($username, $password);
                
                if ($result) {
                    $success = 'Compte créé avec succès ! Vous pouvez vous connecter.';
                } else {
                    $error = 'Cet utilisateur existe déjà';
                }
            }
        }

        include 'views/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>