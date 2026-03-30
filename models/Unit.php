<?php
class Unit {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getPredefinedNames() {
        return [
            // Terran
            'Marine',
            'Siege Tank',
            'Viking',
            
            // Protoss
            'Zealot',
            'Stalker',
            'Phénix',
            
            // Zerg
            'Zergling',
            'Roach',
            'Mutalisk'
        ];
    }

    public function getAllUnits() {
        $stmt = $this->pdo->query('SELECT * FROM units ORDER BY name');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnitById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM units WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUnit($name, $health, $damage, $armor, $speed, $cost) {
        $stmt = $this->pdo->prepare('INSERT INTO units (name, health, damage, armor, speed, cost) VALUES (?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$name, $health, $damage, $armor, $speed, $cost]);
    }

    public function updateUnit($id, $name, $health, $damage, $armor, $speed, $cost) {
        $stmt = $this->pdo->prepare('UPDATE units SET name = ?, health = ?, damage = ?, armor = ?, speed = ?, cost = ? WHERE id = ?');
        return $stmt->execute([$name, $health, $damage, $armor, $speed, $cost, $id]);
    }

    public function deleteUnit($id) {
        $stmt = $this->pdo->prepare('DELETE FROM units WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>