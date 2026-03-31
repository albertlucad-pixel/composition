<?php
class CompositionController {
    private $compositionModel;
    private $unitModel;

    public function __construct($compositionModel, $unitModel) {
        $this->compositionModel = $compositionModel;
        $this->unitModel = $unitModel;
    }

    public function list() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $compositions = $this->compositionModel->getCompositionsByUser($_SESSION['user_id']);
        include 'views/compositions/list.php';
    }

    public function publicList() {
        $compositions = $this->compositionModel->getAllCompositions();
        $isPublic = true;
        include 'views/compositions/public_list.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $units = $this->unitModel->getAllUnits();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isPrivate = isset($_POST['is_private']) ? 1 : 0;
            
            $compositionId = $this->compositionModel->createComposition(
                $_SESSION['user_id'],
                $_POST['name'],
                $_POST['description'],
                $isPrivate
            );

            // Ajouter les unités
            if (isset($_POST['units']) && is_array($_POST['units'])) {
                foreach ($_POST['units'] as $unitId => $quantity) {
                    if ($quantity > 0) {
                        $this->compositionModel->addUnitToComposition($compositionId, $unitId, $quantity);
                    }
                }
            }

            header('Location: index.php?page=compositions');
            exit;
        }

        include 'views/compositions/form.php';
    }

    public function detail() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?page=compositions');
            exit;
        }

        $composition = $this->compositionModel->getCompositionById($_GET['id'], $_SESSION['user_id']);
        
        if (!$composition) {
            header('Location: index.php?page=compositions');
            exit;
        }

        $units = $this->compositionModel->getCompositionUnits($_GET['id']);
        include 'views/compositions/detail.php';
    }

    public function publicDetail() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=public_compositions');
            exit;
        }

        $composition = $this->compositionModel->getCompositionByIdPublic($_GET['id']);
        
        if (!$composition) {
            header('Location: index.php?page=public_compositions');
            exit;
        }

        $units = $this->compositionModel->getCompositionUnits($_GET['id']);
        $isPublic = true;
        include 'views/compositions/public_detail.php';
    }

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?page=compositions');
            exit;
        }

        $composition = $this->compositionModel->getCompositionById($_GET['id'], $_SESSION['user_id']);
        
        if (!$composition) {
            header('Location: index.php?page=compositions');
            exit;
        }

        $units = $this->unitModel->getAllUnits();
        $compositionUnits = $this->compositionModel->getCompositionUnits($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isPrivate = isset($_POST['is_private']) ? 1 : 0;
            
            $this->compositionModel->updateComposition(
                $_GET['id'],
                $_POST['name'],
                $_POST['description'],
                $isPrivate
            );

            // Supprimer les anciennes unités
            $this->compositionModel->deleteCompositionUnits($_GET['id']);

            // Ajouter les nouvelles unités
            if (isset($_POST['units']) && is_array($_POST['units'])) {
                foreach ($_POST['units'] as $unitId => $quantity) {
                    if ($quantity > 0) {
                        $this->compositionModel->addUnitToComposition($_GET['id'], $unitId, $quantity);
                    }
                }
            }

            header('Location: index.php?page=compositions');
            exit;
        }

        include 'views/compositions/edit.php';
    }

    public function delete() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if (isset($_GET['id'])) {
            // Vérifier que la composition appartient à l'utilisateur
            $composition = $this->compositionModel->getCompositionById($_GET['id'], $_SESSION['user_id']);
            if ($composition) {
                $this->compositionModel->deleteComposition($_GET['id']);
            }
        }

        header('Location: index.php?page=compositions');
        exit;
    }
}
?>