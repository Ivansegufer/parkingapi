<?php
require_once "../config/config.php";
require_once "../database/connection.php";

require_once "../controllers/car_controller.php";
require_once "../models/car_model.php";

$carController = new CarController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header('Content-Type: application/json');
    if (isset($_GET["plate_number"])) {
        $result = $carController->getByPlateNumber($_GET["plate_number"]);
        if (!$result) {
            http_response_code(404);
            return;
        }
        echo json_encode($result, JSON_NUMERIC_CHECK);
    } else {
        $results = $carController->getAll();
        echo json_encode($results, JSON_NUMERIC_CHECK);
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $carController->create();
    if (!$result) {
        http_response_code(400);
    }
} else if ($_SERVER["REQUEST_METHOD"] === "PATCH") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $carController->update();
    if (!$result) {
        http_response_code(400);
    }
}
?>