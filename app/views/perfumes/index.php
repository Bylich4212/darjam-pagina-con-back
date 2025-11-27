<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Darjam – Perfumes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles.css" />
  <script defer src="js/cart.js"></script>
  <script defer src="js/search.js"></script>
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="perfume-section">
  <div class="cards-grid">

    <?php foreach ($perfumes as $p): ?>
      <article class="perfume-card"
               data-name="<?php echo htmlspecialchars($p['nombre']); ?>"
               data-brand="<?php echo htmlspecialchars($p['marca']); ?>">
        <div class="perfume-image">
          <img src="<?php echo htmlspecialchars($p['imagen']); ?>"
               alt="<?php echo htmlspecialchars($p['marca'] . ' ' . $p['nombre']); ?>">
        </div>

        <div class="perfume-content">
          <h2 class="perfume-name">
            <span><?php echo htmlspecialchars($p['marca']); ?></span><br>
            <?php echo htmlspecialchars($p['nombre']); ?>
          </h2>

          <div class="price-box">
            <?php if (!empty($p['precio_100ml'])): ?>
              <div class="price-line">• Perfume 100ml <span><?php echo $p['precio_100ml']; ?> Bs</span></div>
            <?php endif; ?>
            <?php if (!empty($p['precio_5ml'])): ?>
              <div class="price-line">• Decant 5ml <span><?php echo $p['precio_5ml']; ?> Bs</span></div>
            <?php endif; ?>
            <?php if (!empty($p['precio_10ml'])): ?>
              <div class="price-line">• Decant 10ml <span><?php echo $p['precio_10ml']; ?> Bs</span></div>
            <?php endif; ?>
          </div>

          <p class="perfume-desc">
            <?php echo nl2br(htmlspecialchars($p['descripcion'])); ?>
          </p>

          <div class="perfume-actions">
            <button class="btn-add-cart">Agregar al carrito</button>
            <button class="btn-wpp-one">Consultar</button>
          </div>
        </div>
      </article>
    <?php endforeach; ?>

  </div>
</main>

</body>
</html>
