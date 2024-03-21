<?php
class StandModel extends Connection {
    public function getAllOccupiedStands($establishmentId) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT GROUP_CONCAT(stand_code SEPARATOR ',') AS stand_codes 
            FROM movements
            WHERE establishment_id = :establishment_id
                AND exit_date IS NULL;
        ");

        $stmt->bindParam(":establishment_id", $establishmentId, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $result;
    }
}
?>