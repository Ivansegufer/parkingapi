<?php
class CarModel extends Connection {
    public function getAll() {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT id, plate_number,
                model, year, color
            FROM cars;
        ");

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $results;
    }

    public function getByPlateNumber($plate_number) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT id, plate_number,
                model, year, color
            FROM cars
            WHERE plate_number like :plate_number;
        ");

        $stmt->bindParam(":plate_number", $plate_number, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $result;
    }

    public function create($plate_number, $model, $year, $color) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            INSERT INTO cars (plate_number, model, year, color) VALUES
                (:plate_number, :model, :year, :color);
        ");

        $stmt->bindParam(":plate_number", $plate_number, PDO::PARAM_STR);
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