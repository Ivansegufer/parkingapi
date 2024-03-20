<?php
class CarModel extends Connection {
    public function getAllByUserId($userId) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT
                id AS id,
                plate_number AS plateNumber,
                model AS model,
                year AS year,
                color AS color
            FROM cars
            WHERE user_id = :user_id;
        ");

        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $results;
    }

    public function getByPlateNumber($userId, $plateNumber) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT 
                id AS id,
                plate_number AS plateNumber,
                model AS model,
                year AS year,
                color AS color
            FROM cars
            WHERE user_id = :user_id
                AND plate_number like :plate_number;
        ");

        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":plate_number", $plateNumber, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $result;
    }

    public function create($userId, $plateNumber, $model, $year, $color) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            INSERT INTO cars (user_id, plate_number, model, year, color) VALUES
                (:user_id, :plate_number, :model, :year, :color);
        ");

        $stmt->bindParam(":user_id", $userId, PDO::PARAM_STR);
        $stmt->bindParam(":plate_number", $plateNumber, PDO::PARAM_STR);
        $stmt->bindParam(":model", $model, PDO::PARAM_STR);
        $stmt->bindParam(":year", $year, PDO::PARAM_INT);
        $stmt->bindParam(":color", $color, PDO::PARAM_STR);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }

    public function update($id, $color) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            UPDATE cars SET color = :color
            WHERE id = :id
        ");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":color", $color, PDO::PARAM_STR);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }
}
?>