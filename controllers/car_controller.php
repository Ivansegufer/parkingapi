<?php
class CarController {
    public function getAllByUserId($userId) {
        $carModel = new CarModel();
        return $carModel->getAllByUserId($userId);
    }

    public function getByPlateNumber($userId, $plate_number) {
        $carModel = new CarModel();
        return $carModel->getByPlateNumber($userId, $plate_number);
    }

    public function create() {
        $carModel = new CarModel();
        return $carModel->create(
            $_POST["userId"],
            $_POST["plateNumber"],
            $_POST["model"],
            $_POST["year"],
            $_POST["color"]
        );
    }

    public function update() {
        $carModel = new CarModel();
        return $carModel->update(
            $_POST["id"],
            $_POST["color"]
        );
    }
}
?>