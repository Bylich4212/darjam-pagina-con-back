<?php
// app/controllers/AdminController.php

class AdminController
{
    private function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=loginForm");
            exit;
        }
    }

    // Pantalla de "Agregar perfume/decant" + botones admin
    public function createPerfumeForm()
    {
        $this->checkAuth();
        $error   = $error   ?? null;
        $success = $success ?? null;

        require __DIR__ . '/../views/admin/perfumes_create.php';
    }

    // Guardar nuevo perfume/decant
    public function savePerfume()
    {
        $this->checkAuth();

        $nombre      = $_POST['nombre']       ?? '';
        $marca       = $_POST['marca']        ?? '';
        $tipo        = $_POST['tipo']         ?? 'perfume';
        $mlPrincipal = $_POST['ml_principal'] ?? 100;

        $precio100   = $_POST['precio_100ml'] ?? null;
        $precio5     = $_POST['precio_5ml']   ?? null;
        $precio10    = $_POST['precio_10ml']  ?? null;
        $descripcion = $_POST['descripcion']  ?? '';

        if (trim($nombre) === '' || trim($marca) === '' || trim($descripcion) === '') {
            $error = "Nombre, marca y descripción son obligatorios.";
            require __DIR__ . '/../views/admin/perfumes_create.php';
            return;
        }

        // Normalizar precios (vacío -> NULL)
        $precio100 = ($precio100 === '' ? null : $precio100);
        $precio5   = ($precio5   === '' ? null : $precio5);
        $precio10  = ($precio10  === '' ? null : $precio10);

        // Normalizar tamaño principal
        if ($mlPrincipal === '' || !is_numeric($mlPrincipal)) {
            $mlPrincipal = 100;
        }

        // Manejo de imagen obligatoria al crear
        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
            $error = "Error al subir la imagen. Asegurate de seleccionar un archivo válido.";
            require __DIR__ . '/../views/admin/perfumes_create.php';
            return;
        }

        $uploadDir = __DIR__ . '/../../public/assets/perfumes/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName   = time() . '_' . basename($_FILES['imagen']['name']);
        $targetPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
            $error = "No se pudo guardar el archivo subido.";
            require __DIR__ . '/../views/admin/perfumes_create.php';
            return;
        }

        $rutaImagen = "assets/perfumes/" . $fileName;

        Perfume::create([
            'nombre'       => $nombre,
            'marca'        => $marca,
            'tipo'         => $tipo,
            'ml_principal' => (int)$mlPrincipal,
            'precio_100ml' => $precio100,
            'precio_5ml'   => $precio5,
            'precio_10ml'  => $precio10,
            'descripcion'  => $descripcion,
            'imagen'       => $rutaImagen,
            'created_by'   => $_SESSION['user_id'],
        ]);

        $success = "Perfume/decant guardado correctamente 🎉";
        require __DIR__ . '/../views/admin/perfumes_create.php';
    }

    // Lista para MODIFICAR / ELIMINAR
    public function listPerfumes()
    {
        $this->checkAuth();

        $perfumes = Perfume::all();

        require __DIR__ . '/../views/admin/perfumes_list.php';
    }

    // Formulario de edición
    public function editPerfumeForm()
    {
        $this->checkAuth();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("ID no válido");
        }

        $perfume = Perfume::find($id);
        if (!$perfume) {
            die("Perfume no encontrado");
        }

        require __DIR__ . '/../views/admin/perfume_edit.php';
    }

    // Guardar cambios de edición
    public function updatePerfume()
    {
        $this->checkAuth();

        $id = $_POST['id'] ?? null;
        if (!$id) {
            die("ID no válido");
        }

        $perfumeActual = Perfume::find($id);
        if (!$perfumeActual) {
            die("Perfume no encontrado");
        }

        $nombre      = $_POST['nombre']       ?? '';
        $marca       = $_POST['marca']        ?? '';
        $tipo        = $_POST['tipo']         ?? 'perfume';
        $mlPrincipal = $_POST['ml_principal'] ?? ($perfumeActual['ml_principal'] ?? 100);

        $precio100   = $_POST['precio_100ml'] ?? null;
        $precio5     = $_POST['precio_5ml']   ?? null;
        $precio10    = $_POST['precio_10ml']  ?? null;
        $descripcion = $_POST['descripcion']  ?? '';

        if (trim($nombre) === '' || trim($marca) === '' || trim($descripcion) === '') {
            $error   = "Nombre, marca y descripción son obligatorios.";
            $perfume = $perfumeActual;
            require __DIR__ . '/../views/admin/perfume_edit.php';
            return;
        }

        // Normalizar precios
        $precio100 = ($precio100 === '' ? null : $precio100);
        $precio5   = ($precio5   === '' ? null : $precio5);
        $precio10  = ($precio10  === '' ? null : $precio10);

        if ($mlPrincipal === '' || !is_numeric($mlPrincipal)) {
            $mlPrincipal = $perfumeActual['ml_principal'] ?? 100;
        }

        // Imagen: opcional al editar
        $rutaImagen = $perfumeActual['imagen'];

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/assets/perfumes/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // borrar imagen anterior
            $rutaAnterior = __DIR__ . '/../../public/' . $perfumeActual['imagen'];
            if (file_exists($rutaAnterior)) {
                unlink($rutaAnterior);
            }

            $fileName   = time() . '_' . basename($_FILES['imagen']['name']);
            $targetPath = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
                $error   = "No se pudo guardar la nueva imagen.";
                $perfume = $perfumeActual;
                require __DIR__ . '/../views/admin/perfume_edit.php';
                return;
            }

            $rutaImagen = "assets/perfumes/" . $fileName;
        }

        Perfume::update($id, [
            'nombre'       => $nombre,
            'marca'        => $marca,
            'tipo'         => $tipo,
            'ml_principal' => (int)$mlPrincipal,
            'precio_100ml' => $precio100,
            'precio_5ml'   => $precio5,
            'precio_10ml'  => $precio10,
            'descripcion'  => $descripcion,
            'imagen'       => $rutaImagen,
        ]);

        header("Location: index.php?c=admin&a=listPerfumes");
        exit;
    }

    // Eliminar perfume / decant
    public function deletePerfume()
    {
        $this->checkAuth();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("ID no válido");
        }

        Perfume::delete($id);

        header("Location: index.php?c=admin&a=listPerfumes");
        exit;
    }
}
