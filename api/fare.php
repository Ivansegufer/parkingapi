<?php
require_once "../config/config.php";
require_once "../database/connection.php";

require_once "../controllers/fare_controller.php";
require_once "../models/fare_model.php";

$fareController = new FareController();
$result = $fareController->getDefault();

header('Content-Type: application/json');
echo json_encode($result, JSON_NUMERIC_CHECK);
?>