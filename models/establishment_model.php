<?php
class EstablishmentModel extends Connection {
    public function create($userId, $name, $description, $address, $totalStands, $fare, $standRowsJson, $standColumnsJson) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            INSERT INTO establishments (user_id, name, description, address, total_stands, fare, stand_rows_json, stand_columns_json) VALUES
                (:user_id, :name, :description, :address, :total_stands, :fare, :stand_rows_json, :stand_columns_json);
        ");

        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":total_stands", $totalStands, PDO::PARAM_STR);
        $stmt->bindParam(":fare", $fare);
        $stmt->bindParam(":stand_rows_json", $standRowsJson);
        $stmt->bindParam(":stand_columns_json", $standColumnsJson);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }

    public function update($id, $name, $description, $address, $totalStands, $fare, $standRowsJson, $standColumnsJson) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            UPDATE establishments SET name = :name,
                description = :description, address = :address, 
                total_stands = :total_stands, fare = :fare,
                stand_rows_json = :stand_rows_json,
                stand_columns_json = :stand_columns_json
            WHERE id = :id;
        ");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":total_stands", $totalStands, PDO::PARAM_STR);
        $stmt->bindParam(":fare", $fare);
        $stmt->bindParam(":stand_rows_json", $standRowsJson);
        $stmt->bindParam(":stand_columns_json", $standColumnsJson);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }

    public function increaseOccupiedStands($id) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            UPDATE establishments SET total_occupied_stands = (total_occupied_stands + 1)
            WHERE id = :id;
        ");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }

    public function decreaseOccupiedStands($id) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            UPDATE establishments SET total_occupied_stands = (total_occupied_stands - 1)
            WHERE id = :id;
        ");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }

    public function getAllByUserId($userId) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT
                id AS id,
                name AS name,
                description AS description, 
                address AS address,
                total_stands AS totalStands, 
                total_occupied_stands AS totalOccupiedStands,
                fare AS fare,
                stand_rows_json AS standRowsJson,
                stand_columns_json AS standColumnsJson
            FROM establishments
            WHERE user_id = :user_id;
        ");

        $stmt->bindParam(":user_id", $userId, PDO::PARAM_STR);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $results;
    }
}