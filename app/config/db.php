<?php

class Database
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null) {

            // 🔥 CONFIGURACIÓN PARA XAMPP 🔥
            $host = 'localhost';    // servidor MySQL de XAMPP
            $db   = 'darjam';       // nombre de tu base de datos en phpMyAdmin
            $user = 'root';         // usuario por defecto en XAMPP
            $pass = '';             // contraseña VACÍA en XAMPP

            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

            try {
                self::$instance = new PDO($dsn, $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("❌ Error de conexión a la base de datos: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
