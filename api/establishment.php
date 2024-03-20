<?php
require_once "../config/config.php";
require_once "../config/cors.php";
require_once "../database/connection.php";

require_once "../models/establishment_model.php";
require_once "../controllers/establishment_controller.php";

$establishmentController = new EstablishmentController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header('Content-Type: application/json');
    $result = $establishmentController->getAllByUserId($_GET["user_id"]);
    echo json_encode($result, JSON_NUMERIC_CHECK);
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $establishmentController->create();
    if (!$result) {
        http_response_code(400);
    }
} else if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $establishmentController->update();
    if (!$result) {
        http_response_code(400);
    }
}
?>