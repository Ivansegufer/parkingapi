<?php
class MovementController {
    public function getAllActivesByUserId($userId) {
        $movementModel = new MovementModel();
        return $movementModel->getAllActivesByUserId($userId);
    }

    /*
    public function getAllByEnterDate($enterDate) {
        $movementModel = new MovementModel();
        return $movementModel->getAllByEnterDate();
    }
    */

    public function create() {
        $movementModel = new MovementModel();
        $establishmentModel = new EstablishmentModel();
        $movementId = $movementModel->create(
            $_POST["carId"],
            $_POST["establishmentId"],
            $_POST["enterDate"]
        );

        if (!$movementId) {
            return false;
        }

        return $establishmentModel->increaseOccupiedStands($movementId);
    }

    public function update() {
        $movementModel = new MovementModel();
        return $movementModel->update(
            $_POST["id"],
            $_POST["amount"],
            $_POST["exitDate"]
        );
    }
}
?>