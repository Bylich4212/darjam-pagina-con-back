<?php
// app/models/User.php

class User {
    public static function create($nombre, $email, $passwordPlano) {
        $pdo  = Database::getConnection();
        $hash = password_hash($passwordPlano, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $hash]);
    }

    public static function findByEmail($email) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function verifyLogin($email, $passwordPlano) {
        $user = self::findByEmail($email);
        if ($user && password_verify($passwordPlano, $user['password'])) {
            return $user;
        }
        return false;
    }
}
