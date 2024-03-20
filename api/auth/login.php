<?php
require_once "../../config/config.php";
require_once "../../config/cors.php";
require_once "../../database/connection.php";

require_once "../../models/user_model.php";
require_once "../../controllers/auth_controller.php";

$authController = new AuthController();

header('Content-Type: application/json');
$_POST = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json');
    $result = $authController->login();

    if (!$result) {
        http_response_code(401);
        return;
    }

    echo json_encode($result, JSON_NUMERIC_CHECK);
}
?>