<?php
class EstablishmentController {
    public function getAllByUserId($userId) {
        $establishmentModel = new EstablishmentModel();
        return $establishmentModel->getAllByUserId($userId);
    }

    public function create() {
        $establishmentModel = new EstablishmentModel();
        return $establishmentModel->create(
            $_POST["userId"],
            $_POST["name"],
            $_POST["description"],
            $_POST["address"],
            $_POST["totalStands"],
            $_POST["fare"],
            $_POST["standRowsJson"],
            $_POST["standColumnsJson"]
        );
    }

    public function update() {
        $establishmentModel = new EstablishmentModel();
        return $establishmentModel->update(
            $_POST["id"],
            $_POST["name"],
            $_POST["description"],
            $_POST["address"],
            $_POST["totalStands"],
            $_POST["fare"],
            $_POST["standRowsJson"],
            $_POST["standColumnsJson"]
        );
    }
}
?>