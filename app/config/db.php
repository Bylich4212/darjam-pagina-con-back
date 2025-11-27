<?php
// app/config/db.php

class Database {
    private static $instance = null;

    public static function getConnection() {
        if (self::$instance === null) {
            $host = 'db';          // nombre del servicio en docker-compose
            $db   = 'darjam';
            $user = 'darjam';
            $pass = 'darjampass';
            $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

            try {
                self::$instance = new PDO($dsn, $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
