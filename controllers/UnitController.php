<?php
class UnitController {
    private $unitModel;

    public function __construct($unitModel) {
        $this->unitModel = $unitModel;
    }

    public function list() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $units = $this->unitModel->getAllUnits();
        include 'views/units/list.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $predefinedNames = $this->unitModel->getPredefinedNames();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->unitModel->createUnit(
                $_POST['name'],
                $_POST['health'],
                $_POST['damage'],
                $_POST['armor'],
                $_POST['speed'],
                $_POST['cost']
            );
            header('Location: index.php?page=units');
            exit;
        }

        include 'views/units/form.php';
    }

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?page=units');
            exit;
        }

        $unit = $this->unitModel->getUnitById($_GET['id']);
        
        if (!$unit) {
            header('Location: index.php?page=units');
            exit;
        }

        $predefinedNames = $this->unitModel->getPredefinedNames();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->unitModel->updateUnit(
                $_GET['id'],
                $_POST['name'],
                $_POST['health'],
                $_POST['damage'],
                $_POST['armor'],
                $_POST['speed'],
                $_POST['cost']
            );
            header('Location: index.php?page=units');
            exit;
        }

        include 'views/units/edit.php';
    }

    public function delete() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if (isset($_GET['id'])) {
            $this->unitModel->deleteUnit($_GET['id']);
        }

        header('Location: index.php?page=units');
        exit;
    }
}
?>