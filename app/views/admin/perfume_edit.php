<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Editar Perfume / Decant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="perfume-section">
  <div style="max-width:600px; margin:40px auto; color:#fffbe5;">

    <div class="admin-actions">
      <a href="index.php?c=admin&a=createPerfumeForm" class="admin-btn admin-btn-primary">
        Agregar
      </a>
      <a href="index.php?c=admin&a=listPerfumes" class="admin-btn">
        Volver a lista
      </a>
    </div>

    <h1 style="margin-bottom:16px; font-size:24px; letter-spacing:0.18em; text-transform:uppercase;">
      Editar Perfume / Decant
    </h1>

    <?php if (!empty($error)): ?>
      <p style="color:#ff8080;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="index.php?c=admin&a=updatePerfume" method="post" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:12px;">
      <input type="hidden" name="id" value="<?php echo $perfume['id']; ?>">

      <input
        type="text"
        name="nombre"
        placeholder="Nombre del perfume"
        value="<?php echo htmlspecialchars($perfume['nombre']); ?>"
        required
      >

      <input
        type="text"
        name="marca"
        placeholder="Marca"
        value="<?php echo htmlspecialchars($perfume['marca']); ?>"
        required
      >
      
      <label style="font-size:14px; margin-bottom:-5px; color:#f4d58a;">Estado:</label>
      <select name="activo" style="padding:10px;">
        <option value="1" <?php echo ($perfume['activo'] == 1) ? 'selected' : ''; ?>>
           Activo (Visible en tienda)
        </option>
        <option value="0" <?php echo ($perfume['activo'] == 0) ? 'selected' : ''; ?>>
           Inactivo (Oculto)
        </option>
      </select>

      <label style="font-size:14px; margin-bottom:-5px; color:#f4d58a;">Tipo de producto:</label>
      <select name="tipo" style="padding:10px;">
        <option value="perfume" <?php echo $perfume['tipo'] === 'perfume' ? 'selected' : ''; ?>>
          Perfume
        </option>
        <option value="decant" <?php echo $perfume['tipo'] === 'decant' ? 'selected' : ''; ?>>
          Decant
        </option>
      </select>

      <input
        type="number"
        name="ml_principal"
        min="1"
        value="<?php echo htmlspecialchars($perfume['ml_principal'] ?? 100); ?>"
        placeholder="Tamaño principal (ml)"
      >

      <input
        type="number"
        step="0.01"
        name="precio_100ml"
        placeholder="Precio tamaño principal (opcional)"
        value="<?php echo htmlspecialchars($perfume['precio_100ml']); ?>"
      >

      <input
        type="number"
        step="0.01"
        name="precio_5ml"
        placeholder="Precio 5ml (opcional)"
        value="<?php echo htmlspecialchars($perfume['precio_5ml']); ?>"
      >

      <input
        type="number"
        step="0.01"
        name="precio_10ml"
        placeholder="Precio 10ml (opcional)"
        value="<?php echo htmlspecialchars($perfume['precio_10ml']); ?>"
      >

      <textarea
        name="descripcion"
        rows="4"
        placeholder="Descripción breve"
        required
      ><?php echo htmlspecialchars($perfume['descripcion']); ?></textarea>

      <div style="margin-top:10px;">
        <p>Imagen actual:</p>
        <img src="<?php echo htmlspecialchars($perfume['imagen']); ?>" width="120">
      </div>

      <label>Nueva imagen (opcional, JPG/PNG):</label>
      <input type="file" name="imagen" accept="image/*">

      <button type="submit" class="btn-add-cart" style="cursor:pointer; margin-top:20px;">Guardar cambios</button>
    </form>
  </div>
</main>

</body>
</html>