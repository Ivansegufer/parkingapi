<?php
class FareController {
    public function getDefault() {
        $fareModel = new FareModel();
        return $fareModel->getDefault();
    }
}
?>