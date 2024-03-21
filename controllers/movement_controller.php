<?php
class MovementController {
    public function getAllActivesByUserId($userId) {
        $movementModel = new MovementModel();
        return $movementModel->getAllActivesByUserId($userId);
    }

    public function create() {
        $movementModel = new MovementModel();
        $establishmentModel = new EstablishmentModel();
        $success = $movementModel->create(
            $_POST["carId"],
            $_POST["establishmentId"],
            $_POST["enterDate"],
            $_POST["standCode"]
        );

        if (!$success) {
            return false;
        }

        return $establishmentModel->increaseOccupiedStands($_POST["establishmentId"]);
    }

    public function update() {
        $movementModel = new MovementModel();
        $establishmentModel = new EstablishmentModel();
        $success = $movementModel->update(
            $_POST["id"],
            $_POST["amount"],
            $_POST["exitDate"]
        );

        if (!$success) {
            return false;
        }

        return $establishmentModel->decreaseOccupiedStands($_POST["establishmentId"]);
    }
}
?>