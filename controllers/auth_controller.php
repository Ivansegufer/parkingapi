<?php
class AuthController {
    public function login() {
        $userModel = new UserModel();
        $hashedPassword = hash('sha256', $_POST['password']);
        $user = $userModel->getByEmail($_POST['email']);
        if ($user && $hashedPassword == $user['password'])
        {
            unset($user['password']);
            return $user;
        }
    }

    public function signup() {
        $userModel = new UserModel();
        $user = $userModel->getByEmail($_POST['email']);
        if ($user) {
            return false;
        }

        $hashedPassword = hash('sha256', $_POST['password']);
        return $userModel->create(
            $_POST['name'],
            $_POST['email'],
            $_POST['profileImage'],
            $hashedPassword
        );
    }
}
?>