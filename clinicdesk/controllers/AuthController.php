<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../core/Auth.php';

class AuthController
{
    public function login()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function handleLogin()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();
        $user = $userModel->findByEmail($email);

        if ($user && $user['is_active'] == 1 && password_verify($password, $user['password'])) {
            Auth::login($user);
            header("Location: index.php?page=dashboard");
            exit;
        }

        echo "Invalid credentials";
    }

    public function logout()
    {
        Auth::logout();
    }
}