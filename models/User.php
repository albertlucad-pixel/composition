<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare('SELECT id, username, created_at FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validatePassword($password) {
        // Vérifier que le mot de passe contient :
        // - Au moins 1 majuscule
        // - Au moins 1 minuscule
        // - Au moins 1 chiffre
        // - Au moins 1 caractère spécial
        // - Au minimum 8 caractères
        $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        return preg_match($regex, $password) === 1;
    }

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    public function createUser($username, $password) {
        // Vérifier si l'utilisateur existe déjà
        $existing = $this->getUserByUsername($username);
        if ($existing) {
            return false;
        }

        // Hasher le mot de passe
        $hashedPassword = $this->hashPassword($password);

        $stmt = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        return $stmt->execute([$username, $hashedPassword]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>