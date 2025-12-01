<?php
// app/models/Perfume.php

class Perfume
{
    // Para mostrar perfumes en la página pública (SOLO ACTIVOS)
    public static function allPerfumes()
    {
        $pdo = Database::getConnection();
        // Agregamos "AND activo = 1" para que no se vean los ocultos
        $stmt = $pdo->query("SELECT * FROM perfumes WHERE tipo = 'perfume' AND activo = 1 ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Para mostrar decants en la página pública (SOLO ACTIVOS)
    public static function allDecants()
    {
        $pdo = Database::getConnection();
        // Agregamos "AND activo = 1" para que no se vean los ocultos
        $stmt = $pdo->query("SELECT * FROM perfumes WHERE tipo = 'decant' AND activo = 1 ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Para el panel admin (lista completa, incluye inactivos)
    public static function all()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM perfumes ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar un perfume por ID
    public static function find($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM perfumes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear perfume / decant
    public static function create($data)
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            INSERT INTO perfumes 
            (nombre, marca, tipo, ml_principal, precio_100ml, precio_5ml, precio_10ml, descripcion, imagen, created_by)
            VALUES (:nombre, :marca, :tipo, :ml_principal, :precio_100ml, :precio_5ml, :precio_10ml, :descripcion, :imagen, :created_by)
        ");

        $stmt->execute([
            ':nombre'       => $data['nombre'],
            ':marca'        => $data['marca'],
            ':tipo'         => $data['tipo'],
            ':ml_principal' => $data['ml_principal'],
            ':precio_100ml' => $data['precio_100ml'],
            ':precio_5ml'   => $data['precio_5ml'],
            ':precio_10ml'  => $data['precio_10ml'],
            ':descripcion'  => $data['descripcion'],
            ':imagen'       => $data['imagen'],
            ':created_by'   => $data['created_by'] ?? null,
        ]);
    }

    // Actualizar perfume / decant (AHORA INCLUYE ACTIVO)
    public static function update($id, $data)
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            UPDATE perfumes
            SET nombre       = :nombre,
                marca        = :marca,
                tipo         = :tipo,
                ml_principal = :ml_principal,
                precio_100ml = :precio_100ml,
                precio_5ml   = :precio_5ml,
                precio_10ml  = :precio_10ml,
                descripcion  = :descripcion,
                imagen       = :imagen,
                activo       = :activo
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id'           => $id,
            ':nombre'       => $data['nombre'],
            ':marca'        => $data['marca'],
            ':tipo'         => $data['tipo'],
            ':ml_principal' => $data['ml_principal'],
            ':precio_100ml' => $data['precio_100ml'],
            ':precio_5ml'   => $data['precio_5ml'],
            ':precio_10ml'  => $data['precio_10ml'],
            ':descripcion'  => $data['descripcion'],
            ':imagen'       => $data['imagen'],
            ':activo'       => $data['activo'] // Guardamos el estado (1 o 0)
        ]);
    }

    // Eliminar perfume (y su imagen)
    public static function delete($id)
    {
        $pdo = Database::getConnection();

        $perfume = self::find($id);
        if (!$perfume) {
            return false;
        }

        // Borrar imagen física
        $ruta = __DIR__ . '/../../public/' . $perfume['imagen'];
        if (file_exists($ruta)) {
            unlink($ruta);
        }

        $stmt = $pdo->prepare("DELETE FROM perfumes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}