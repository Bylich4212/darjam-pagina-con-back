<header class="header">
  <div class="header-top">

    <!-- LOGO (puede ser botón a HOME o al login secreto si querés) -->
    
    <a href="index.php?c=auth&a=login" class="logo-area">
  <img src="assets/images/logo.png" alt="Darjam Logo" class="logo-img">
</a>


    <!-- BUSCADOR + CARRITO -->
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
      <!-- HOME -->
      <li>
        <a href="index.php?c=perfume&a=home" class="nav-link">INICIO</a>
      </li>

      <!-- PERFUMES -->
      <li>
        <a href="index.php?c=perfume&a=index" class="nav-link">PERFUMES</a>
      </li>

      <!-- DECANTS -->
      <li>
        <a href="index.php?c=perfume&a=decants" class="nav-link">DECANTS</a>
      </li>
    </ul>
  </nav>
</header>
