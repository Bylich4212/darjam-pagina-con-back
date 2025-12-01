// js/search.js

// Buscador reutilizable para perfumes.html y decants.html

const searchArea   = document.getElementById('searchArea');
const searchToggle = document.getElementById('searchToggle');
const searchInput  = document.getElementById('searchInput');
const cards        = document.querySelectorAll('.perfume-card');

// Si por alguna razón este archivo se carga en una página sin buscador, salimos para no dar error
if (searchArea && searchToggle && searchInput && cards.length > 0) {

  // Abrir/cerrar el input al hacer click en la lupa
  searchToggle.addEventListener('click', () => {
    searchArea.classList.toggle('open');

    if (searchArea.classList.contains('open')) {
      searchInput.focus();
    } else {
      searchInput.value = "";
      filterPerfumes(""); // Reseteamos al cerrar
    }
  });

  // Filtrar mientras se escribe
  searchInput.addEventListener('input', (e) => {
    const value = e.target.value.trim().toLowerCase();
    filterPerfumes(value);
  });

  function filterPerfumes(query) {
    cards.forEach(card => {
      // Obtenemos los datos desde el HTML (data-name y data-brand)
      const name  = (card.dataset.name  || "").toLowerCase();
      const brand = (card.dataset.brand || "").toLowerCase();

      const matches =
        query === "" ||
        name.includes(query) ||
        brand.includes(query);

      // === AQUÍ ESTÁ LA SOLUCIÓN AL CONFLICTO CON CSS ===
      if (matches) {
        // Si coincide, quitamos cualquier estilo inline para que el CSS original (flex) mande
        card.style.removeProperty('display');
      } else {
        // Si NO coincide, usamos !important para forzar que se oculte, ganándole al CSS
        card.style.setProperty('display', 'none', 'important');
      }
    });

    // Lógica opcional: Centrar si queda solo 1 resultado
    const visibleCards = [...cards].filter(c => c.style.display !== "none");
    const grid = document.querySelector(".cards-grid");

    if (!grid) return;

    if (visibleCards.length === 1) {
      grid.classList.add("single-result");
    } else {
      grid.classList.remove("single-result");
    }
  }
}