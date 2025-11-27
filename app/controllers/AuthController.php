<?php
// app/controllers/AuthController.php

class AuthController {
    public function registerForm() {
        require __DIR__ . '/../views/auth/register.php';
    }

    public function register() {
        $nombre   = $_POST['nombre'] ?? '';
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($nombre && $email && $password) {
            User::create($nombre, $email, $password);
            header("Location: index.php?c=auth&a=loginForm");
            exit;
        }

        $error = "Todos los campos son obligatorios";
        require __DIR__ . '/../views/auth/register.php';
    }

    public function loginForm() {
        require __DIR__ . '/../views/auth/login.php';
    }

    public function login() {
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::verifyLogin($email, $password);

        if ($user) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            header("Location: index.php?c=admin&a=createPerfumeForm");
            exit;
        }

        $error = "Credenciales incorrectas";
        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
