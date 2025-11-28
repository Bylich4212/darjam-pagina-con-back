<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Darjam – Perfumes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="perfume-section">
  <div class="cards-grid">

    <?php foreach ($perfumes as $p): ?>
      <article
        class="perfume-card"
        data-name="<?php echo htmlspecialchars($p['nombre']); ?>"
        data-brand="<?php echo htmlspecialchars($p['marca']); ?>"
      >
        <!-- Imagen -->
        <div class="perfume-image">
          <img
            src="<?php echo htmlspecialchars($p['imagen']); ?>"
            alt="<?php echo htmlspecialchars($p['marca'] . ' ' . $p['nombre']); ?>"
          >
        </div>

        <!-- Contenido -->
        <div class="perfume-content">

          <!-- Marca + Nombre -->
          <h2 class="perfume-name">
            <span><?php echo htmlspecialchars(strtoupper($p['marca'])); ?></span><br>
            <?php echo htmlspecialchars($p['nombre']); ?>
          </h2>

          <!-- Caja de precios (mismo look, solo que ml dinámico) -->
          <div class="price-box">
            <?php if ($p['precio_100ml'] !== null): ?>
              <div class="price-line">
                • Perfume <?php echo (int)($p['ml_principal'] ?? 100); ?>ml
                <span><?php echo number_format($p['precio_100ml'], 2, '.', '.'); ?> Bs</span>
              </div>
            <?php endif; ?>

            <?php if ($p['precio_5ml'] !== null): ?>
              <div class="price-line">
                • Decant 5ml
                <span><?php echo number_format($p['precio_5ml'], 2, '.', '.'); ?> Bs</span>
              </div>
            <?php endif; ?>

            <?php if ($p['precio_10ml'] !== null): ?>
              <div class="price-line">
                • Decant 10ml
                <span><?php echo number_format($p['precio_10ml'], 2, '.', '.'); ?> Bs</span>
              </div>
            <?php endif; ?>
          </div>

          <!-- Descripción -->
          <p class="perfume-desc">
            <?php echo nl2br(htmlspecialchars($p['descripcion'])); ?>
          </p>

          <!-- Botones -->
          <div class="perfume-actions">
            <button class="btn-add-cart">Agregar al carrito</button>
            <button class="btn-wpp-one">Consultar</button>
          </div>

        </div>
      </article>
    <?php endforeach; ?>

  </div>
</main>

<!-- JS del buscador y del carrito -->
<script src="js/search.js"></script>
<script src="js/cart.js"></script>

</body>
</html>
