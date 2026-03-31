<?php
class Composition {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getCompositionsByUser($userId) {
        $stmt = $this->pdo->prepare('SELECT * FROM compositions WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPublicCompositionsByUser($userId) {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) as count FROM compositions WHERE user_id = ? AND is_private = 0');
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function countPrivateCompositionsByUser($userId) {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) as count FROM compositions WHERE user_id = ? AND is_private = 1');
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getAllCompositions() {
        $stmt = $this->pdo->query('SELECT c.*, u.username FROM compositions c JOIN users u ON c.user_id = u.id WHERE c.is_private = 0 ORDER BY c.created_at DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompositionById($id, $userId) {
        $stmt = $this->pdo->prepare('SELECT * FROM compositions WHERE id = ? AND user_id = ?');
        $stmt->execute([$id, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCompositionByIdPublic($id) {
        $stmt = $this->pdo->prepare('SELECT c.*, u.username FROM compositions c JOIN users u ON c.user_id = u.id WHERE c.id = ? AND c.is_private = 0');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCompositionUnits($compositionId) {
        $stmt = $this->pdo->prepare('
            SELECT u.*, cu.quantity 
            FROM composition_units cu
            JOIN units u ON cu.unit_id = u.id
            WHERE cu.composition_id = ?
        ');
        $stmt->execute([$compositionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createComposition($userId, $name, $description, $isPrivate = 0) {
        $stmt = $this->pdo->prepare('INSERT INTO compositions (user_id, name, description, is_private) VALUES (?, ?, ?, ?)');
        $result = $stmt->execute([$userId, $name, $description, $isPrivate]);
        return $this->pdo->lastInsertId();
    }

    public function addUnitToComposition($compositionId, $unitId, $quantity) {
        $stmt = $this->pdo->prepare('INSERT INTO composition_units (composition_id, unit_id, quantity) VALUES (?, ?, ?)');
        return $stmt->execute([$compositionId, $unitId, $quantity]);
    }

    public function updateComposition($id, $name, $description, $isPrivate = 0) {
        $stmt = $this->pdo->prepare('UPDATE compositions SET name = ?, description = ?, is_private = ? WHERE id = ?');
        return $stmt->execute([$name, $description, $isPrivate, $id]);
    }

    public function deleteCompositionUnits($compositionId) {
        $stmt = $this->pdo->prepare('DELETE FROM composition_units WHERE composition_id = ?');
        return $stmt->execute([$compositionId]);
    }

    public function deleteComposition($id) {
        $stmt = $this->pdo->prepare('DELETE FROM compositions WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>