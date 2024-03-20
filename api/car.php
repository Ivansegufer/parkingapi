<?php
require_once "../config/config.php";
require_once "../config/cors.php";
require_once "../database/connection.php";

require_once "../models/car_model.php";
require_once "../controllers/car_controller.php";

$carController = new CarController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header('Content-Type: application/json');
    if (isset($_GET["plate_number"])) {
        $result = $carController->getByPlateNumber($_GET["user_id"], $_GET["plate_number"]);
        if (!$result) {
            http_response_code(404);
            echo json_encode(array(
                'status' => false,
                'message' => 'No existe el carro con esa placa'
            ));
            return;
        }
        echo json_encode($result, JSON_NUMERIC_CHECK);
    } else {
        $results = $carController->getAllByUserId($_GET["user_id"]);
        echo json_encode($results, JSON_NUMERIC_CHECK);
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $carController->create();
    if (!$result) {
        http_response_code(400);
    }
} else if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $carController->update();
    if (!$result) {
        http_response_code(400);
    }
}
?>