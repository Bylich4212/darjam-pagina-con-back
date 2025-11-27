<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Login – Darjam</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="perfume-section">
  <div style="max-width:400px; margin:40px auto; color:#fffbe5;">
    <h1>Iniciar sesión</h1>

    <?php if (!empty($error)): ?>
      <p style="color:#ff8080;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="index.php?c=auth&a=login" method="post" style="display:flex; flex-direction:column; gap:10px;">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit" class="btn-add-cart" style="cursor:pointer;">Entrar</button>
    </form>
  </div>
</main>

</body>
</html>
