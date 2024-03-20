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
    $success = $authController->signup();

    if (!$success) {
        http_response_code(400);
        echo json_encode(array(
            'status' => false,
            'message' => 'Ya existe un usuario con el mismo correo electrónico'
        ));
        return;
    }
}
?>