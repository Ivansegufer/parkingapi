<?php
require_once "../config/config.php";
require_once "../config/cors.php";
require_once "../database/connection.php";

require_once "../models/stand_model.php";
require_once "../controllers/stand_controller.php";

$standController = new StandController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header('Content-Type: application/json');
    $results = $standController->getAllOccupiedStands($_GET["establishment_id"]);
    echo json_encode($results);
}
?>