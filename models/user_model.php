<?php
class UserModel extends Connection {
    public function create($name, $email, $profileImage, $hashedPassword) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, profile_image, password) VALUES
                (:name, :email, :profile_image, :password);
        ");

        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":profile_image", $profileImage, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);

        $success = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        return $success;
    }

    public function getByEmail($email) {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT id, name, email, 
                profile_image, password
            FROM users
            WHERE email LIKE :email;
        ");

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $pdo = null;

        return $result;
    }
}
?>