<?php
// app/models/Perfume.php

class Perfume
{
    public static function allPerfumes()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM perfumes WHERE tipo = 'perfume' ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function allDecants()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM perfumes WHERE tipo = 'decant' ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Todos (para panel admin: perfumes + decants)
    public static function all()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM perfumes ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Uno por ID (para editar / borrar)
    public static function find($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM perfumes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            INSERT INTO perfumes 
            (nombre, marca, tipo, precio_100ml, precio_5ml, precio_10ml, descripcion, imagen, created_by)
            VALUES (:nombre, :marca, :tipo, :precio_100ml, :precio_5ml, :precio_10ml, :descripcion, :imagen, :created_by)
        ");

        $stmt->execute([
            ':nombre'       => $data['nombre'],
            ':marca'        => $data['marca'],
            ':tipo'         => $data['tipo'],
            ':precio_100ml' => $data['precio_100ml'],
            ':precio_5ml'   => $data['precio_5ml'],
            ':precio_10ml'  => $data['precio_10ml'],
            ':descripcion'  => $data['descripcion'],
            ':imagen'       => $data['imagen'],
            ':created_by'   => $data['created_by'] ?? null,
        ]);
    }

    // 🔹 Actualizar
    public static function update($id, $data)
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            UPDATE perfumes
            SET nombre = :nombre,
                marca = :marca,
                tipo = :tipo,
                precio_100ml = :precio_100ml,
                precio_5ml = :precio_5ml,
                precio_10ml = :precio_10ml,
                descripcion = :descripcion,
                imagen = :imagen
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id'           => $id,
            ':nombre'       => $data['nombre'],
            ':marca'        => $data['marca'],
            ':tipo'         => $data['tipo'],
            ':precio_100ml' => $data['precio_100ml'],
            ':precio_5ml'   => $data['precio_5ml'],
            ':precio_10ml'  => $data['precio_10ml'],
            ':descripcion'  => $data['descripcion'],
            ':imagen'       => $data['imagen'],
        ]);
    }

    // 🔹 Borrar (registro + imagen)
    public static function delete($id)
    {
        $pdo = Database::getConnection();

        $perfume = self::find($id);
        if (!$perfume) {
            return false;
        }

        // borrar imagen física
        $ruta = __DIR__ . '/../../public/' . $perfume['imagen'];
        if (file_exists($ruta)) {
            unlink($ruta);
        }

        $stmt = $pdo->prepare("DELETE FROM perfumes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
