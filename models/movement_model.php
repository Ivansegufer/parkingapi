<?php
class MovementModel extends Connection {
    public function getAllActives() {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT 
                C.id AS car_id,
                M.id AS movement_id,
                C.plate_number AS plate_number,
                C.model AS model,
                C.year AS year,
                C.color AS color,
                M.enter_date AS enter_date
            FROM movements M
                INNER JOIN cars C ON M.car_id = C.id
            WHERE M.exit_date IS NULL;
        ");

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $results;
    }

    public function getAllByEnterDate($enter_date) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT 
                C.id AS car_id,
                M.id AS movement_id,
                C.plate_number AS plate_number,
                C.model AS model,
                C.year AS year,
                C.color AS color,
                M.amount AS amount,
                M.enter_date AS enter_date,
                M.exit_date AS exit_date
            FROM movements M
                INNER JOIN cars C ON M.car_id = C.id
            WHERE M.exit_date IS NOT NULL
                AND DATE(M.enter_date) = :enter_date
        ");

        $stmt->bindParam(':enter_date', $enter_date, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $results;
    }

    public function create($car_id, $enter_date) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            INSERT INTO movements (car_id, enter_date) VALUES
                (:car_id, :enter_date);
        ");

        $stmt->bindParam(":car_id", $car_id, PDO::PARAM_INT);
        $stmt->bindParam(":enter_date", $enter_date, PDO::PARAM_STR);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }

    public function update($id, $amount, $exit_date) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            UPDATE movements SET 
                amount = :amount, 
                exit_date = :exit_date
            WHERE id = :id;
        ");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":exit_date", $exit_date, PDO::PARAM_STR);
        $stmt->bindParam(":amount", $amount);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }
}
?>