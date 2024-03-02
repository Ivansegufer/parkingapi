<?php
class FareModel extends Connection {
    public function getDefault() {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT id, amount_per_hour
            FROM fares
            LIMIT 1;
        ");

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $result;
    }
}