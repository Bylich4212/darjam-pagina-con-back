<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Darjam – Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles.css" />

  <style>
    .search-area, .cart-icon { display: none !important; }
  </style>
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="home-container">
  
  <div class="welcome-box">
    <h1 class="welcome-title">
      Bienvenido a Darjam
    </h1>
    <p class="welcome-text">
      Descubrí nuestro catálogo de perfumes cuidadosamente seleccionados
      para ofrecerte calidad, elegancia y personalidad en cada fragancia.
    </p>
    <a href="index.php?c=perfume&a=index" class="btn-wpp-one" style="text-decoration:none; display:inline-block; margin-top:15px; padding: 10px 24px;">
      VER PERFUMES
    </a>
  </div>

  <section class="benefits-section">
    <div class="benefits-grid">
      
      <div class="benefit-card">
        <div class="benefit-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
        </div>
        <h3>Envíos Gratuitos</h3>
        <p>
          En compras superiores a <strong>500 Bs</strong> en decants y <strong>1.500 Bs</strong> en perfumes el delivery es gratis.
        </p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        </div>
        <h3>Garantía y Seguro</h3>
        <p>
          Garantizamos que su pedido llegue en orden. Si se pierde o rompe en el camino, le reembolsamos o enviamos otro ítem.
        </p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
        </div>
        <h3>Pago Seguro</h3>
        <p>
          Aceptamos pagos por <strong>QR</strong> y <strong>Efectivo</strong>.
        </p>
      </div>

    </div>
  </section>

  <section class="location-section">
    <h2 class="section-title">NOS ENCONTRAMOS EN</h2>
    <p style="font-size:13px; color:#ccc; margin-bottom:20px;">Visítanos y prueba nuestras fragancias</p>
    
    <div class="map-container">
      <iframe 
        src="https://maps.google.com/maps?q=-17.772475,-63.179004&z=15&output=embed" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>

</main>

</body>
</html>