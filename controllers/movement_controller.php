<?php
class MovementController {
    public function getAllActives() {
        $movementModel = new MovementModel();
        return $movementModel->getAllActives();
    }

    public function getAllByEnterDate($enter_date) {
        $movementModel = new MovementModel();
        return $movementModel->getAllByEnterDate($enter_date);
    }

    public function create() {
        $movementModel = new MovementModel();
        return $movementModel->create(
            $_POST["car_id"],
            $_POST["enter_date"]
        );
    }

    public function update() {
        $movementModel = new MovementModel();
        return $movementModel->update(
            $_POST["id"],
            $_POST["amount"],
            $_POST["exit_date"]
        );
    }
}
?>