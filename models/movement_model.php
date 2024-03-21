<?php
class MovementModel extends Connection {
    public function getAllActivesByUserId($userId) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT 
                C.id AS carId,
                M.id AS movementId,
                C.plate_number AS plateNumber,
                C.model AS model,
                C.year AS year,
                C.color AS color,
                M.enter_date AS enterDate,
                M.stand_code AS standCode,
                E.id AS establishmentId,
                E.name AS establishmentName,
                E.fare AS fare
            FROM movements M
                INNER JOIN establishments E ON M.establishment_id = E.id
                INNER JOIN cars C ON M.car_id = C.id
            WHERE M.exit_date IS NULL
                AND E.user_id = :user_id;
        ");

        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $results;
    }

    public function create($carId, $establishmentId, $enterDate, $standCode) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            INSERT INTO movements (car_id, establishment_id, enter_date, stand_code) VALUES
                (:car_id, :establishment_id, :enter_date, :stand_code);
        ");

        $stmt->bindParam(":car_id", $carId, PDO::PARAM_INT);
        $stmt->bindParam(":establishment_id", $establishmentId, PDO::PARAM_INT);
        $stmt->bindParam(":enter_date", $enterDate, PDO::PARAM_STR);
        $stmt->bindParam(":stand_code", $standCode, PDO::PARAM_STR);

        $success = $stmt->execute();
        
        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }

    public function update($id, $amount, $exitDate) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            UPDATE movements SET
                amount = :amount, 
                exit_date = :exit_date
            WHERE id = :id;
        ");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":exit_date", $exitDate, PDO::PARAM_STR);
        $stmt->bindParam(":amount", $amount);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }
}
?>