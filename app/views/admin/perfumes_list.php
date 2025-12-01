<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administrar Perfumes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="perfume-section">
  <div style="max-width:1100px; margin:40px auto; color:#fffbe5;">

    <div class="admin-actions">
      <a href="index.php?c=admin&a=createPerfumeForm" class="admin-btn admin-btn-primary">
        Agregar
      </a>
      <a href="#" class="admin-btn" style="pointer-events:none; opacity:0.6;">
        Modificar
      </a>
      <a href="#" class="admin-btn admin-btn-danger" style="pointer-events:none; opacity:0.6;">
        Eliminar
      </a>
    </div>

    <h1 style="margin-bottom:16px; text-transform:uppercase;">Administrar Perfumes / Decants</h1>

    <div style="overflow-x: auto;">
        <table style="width:100%; background:#121212; padding:20px; border-radius:10px; border-collapse:collapse;">
          <tr style="border-bottom:1px solid #555;">
            <th style="padding:10px; text-align:left;">ID</th>
            <th style="padding:10px; text-align:left;">Nombre</th>
            <th style="padding:10px; text-align:left;">Marca</th>
            <th style="padding:10px; text-align:left;">Tipo</th>
            
            <th style="padding:10px; text-align:left;">Estado</th>
            
            <th style="padding:10px; text-align:left;">Imagen</th>
            <th style="padding:10px; text-align:left;">Acciones</th>
          </tr>

          <?php foreach ($perfumes as $p): ?>
          <tr style="border-bottom:1px solid #333; font-size: 14px;">
            <td style="padding:10px;"><?php echo $p['id']; ?></td>
            <td style="padding:10px; font-weight:bold;"><?php echo htmlspecialchars($p['nombre']); ?></td>
            <td style="padding:10px; color:#f4d58a;"><?php echo htmlspecialchars($p['marca']); ?></td>
            <td style="padding:10px;"><?php echo htmlspecialchars($p['tipo']); ?></td>
            
            <td style="padding:10px;">
                <?php if ($p['activo'] == 1): ?>
                    <span style="color:#4caf50; font-weight:bold; background:rgba(76,175,80,0.1); padding:4px 8px; border-radius:4px;">
                        🟢 Activo
                    </span>
                <?php else: ?>
                    <span style="color:#ff6b6b; font-weight:bold; background:rgba(255,107,107,0.1); padding:4px 8px; border-radius:4px;">
                        🔴 Inactivo
                    </span>
                <?php endif; ?>
            </td>

            <td style="padding:10px;">
              <img src="<?php echo htmlspecialchars($p['imagen']); ?>" width="50" style="border-radius:4px;">
            </td>
            
            <td style="padding:10px; display:flex; gap:8px;">
              <a href="index.php?c=admin&a=editPerfumeForm&id=<?php echo $p['id']; ?>"
                 class="admin-mini-btn">
                Editar
              </a>

              <a href="index.php?c=admin&a=deletePerfume&id=<?php echo $p['id']; ?>"
                 class="admin-mini-btn admin-mini-btn-danger"
                 onclick="return confirm('¿Seguro que quieres eliminar este perfume/decant?');">
                Eliminar
              </a>
            </td>
          </tr>
          <?php endforeach; ?>

        </table>
    </div>
  </div>
</main>

</body>
</html>