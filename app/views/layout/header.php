<header class="header">
  <div class="header-top">

    <!-- LOGO COMO BOTÓN -->
    <a href="index.php" class="logo-area">
      <img src="assets/images/logo.png" alt="Darjam Logo" class="logo-img">
    </a>

    <!-- BUSCADOR + CARRITO SOLO EN PERFUMES Y DECANTS -->
    <div class="search-area" id="searchArea">
      <button id="searchToggle" class="search-icon" aria-label="Buscar perfumes"></button>

      <input
        type="text"
        id="searchInput"
        class="search-input"
        placeholder="Buscar por nombre o marca..."
      />

      <button class="cart-icon" id="cartButton">
        🛒
        <span id="cartCount" class="cart-badge">0</span>
      </button>
    </div>

  </div>

  <!-- MENÚ -->
  <nav class="nav-menu">
    <ul>
      <li><a href="index.php" class="nav-link">INICIO</a></li>
      <li><a href="index.php?c=perfumes&a=index" class="nav-link">PERFUMES</a></li>
      <li><a href="index.php?c=decants&a=index" class="nav-link">DECANTS</a></li>
    </ul>
  </nav>
</header>
