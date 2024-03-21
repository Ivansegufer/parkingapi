<?php
class StandController {
    public function getAllOccupiedStands($establishmentId) {
        $standModel = new StandModel();
        $result = $standModel->getAllOccupiedStands($establishmentId);
        $standCodes = $result[0]["stand_codes"];
        if ($standCodes === null) {
            return array();
        }
        return explode(",", $standCodes);
    }
}
?>