<?php
class CarController {
    public function getAll() {
        $carModel = new CarModel();
        return $carModel->getAll();
    }

    public function getByPlateNumber($plate_number) {
        $carModel = new CarModel();
        return $carModel->getByPlateNumber($plate_number);
    }

    public function create() {
        $carModel = new CarModel();
        return $carModel->create(
            $_POST["plate_number"],
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