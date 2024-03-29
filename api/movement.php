<?php
require_once "../config/config.php";
require_once "../config/cors.php";
require_once "../database/connection.php";

require_once "../models/movement_model.php";
require_once "../models/establishment_model.php";
require_once "../controllers/movement_controller.php";
require_once "../controllers/establishment_controller.php";

$movementController = new MovementController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header('Content-Type: application/json');
    $results = $movementController->getAllActivesByUserId($_GET["user_id"]);
    echo json_encode($results, JSON_NUMERIC_CHECK);
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $movementController->create();
    if (!$result) {
        http_response_code(400);
    }
} else if ($_SERVER["REQUEST_METHOD"] === "PATCH") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $movementController->update();
    if (!$result) {
        http_response_code(400);
    }
}
?>