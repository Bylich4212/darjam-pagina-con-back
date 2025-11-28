<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Darjam – Admin Perfumes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="perfume-section">
  <div style="max-width:600px; margin:40px auto; color:#fffbe5;">

    <!-- Botones admin -->
    <div class="admin-actions">
      <a href="index.php?c=admin&a=createPerfumeForm" class="admin-btn admin-btn-primary">
        Agregar
      </a>
      <a href="index.php?c=admin&a=listPerfumes" class="admin-btn">
        Modificar
      </a>
      <a href="index.php?c=admin&a=listPerfumes" class="admin-btn admin-btn-danger">
        Eliminar
      </a>
    </div>

    <h1 style="margin-bottom:16px; font-size:24px; letter-spacing:0.18em; text-transform:uppercase;">
      Agregar Perfume / Decant
    </h1>

    <?php if (!empty($error)): ?>
      <p style="color:#ff8080;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <p style="color:#80ff80;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form action="index.php?c=admin&a=savePerfume" method="post" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:12px;">
      <input type="text" name="nombre" placeholder="Nombre del perfume" required>
      <input type="text" name="marca" placeholder="Marca" required>

      <select name="tipo">
        <option value="perfume">Perfume</option>
        <option value="decant">Decant</option>
      </select>

      <!-- Tamaño principal (ml) -->
      <input
        type="number"
        name="ml_principal"
        min="1"
        value="100"
        placeholder="Tamaño principal (ml, ej: 100)"
      >

      <input type="number" step="0.01" name="precio_100ml" placeholder="Precio tamaño principal (opcional)">
      <input type="number" step="0.01" name="precio_5ml" placeholder="Precio 5ml (opcional)">
      <input type="number" step="0.01" name="precio_10ml" placeholder="Precio 10ml (opcional)">

      <textarea name="descripcion" rows="4" placeholder="Descripción breve" required></textarea>

      <label>Imagen (JPG/PNG):</label>
      <input type="file" name="imagen" accept="image/*" required>

      <button type="submit" class="btn-add-cart" style="cursor:pointer;">Guardar</button>
    </form>
  </div>
</main>

</body>
</html>
