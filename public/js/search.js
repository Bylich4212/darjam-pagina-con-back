// js/search.js

// Buscador reutilizable para perfumes.html y decants.html

const searchArea   = document.getElementById('searchArea');
const searchToggle = document.getElementById('searchToggle');
const searchInput  = document.getElementById('searchInput');
const cards        = document.querySelectorAll('.perfume-card');

// Si por alguna razón este archivo se carga en una página sin buscador, salimos
if (searchArea && searchToggle && searchInput && cards.length > 0) {

  // Abrir/cerrar el input al hacer click en la lupa
  searchToggle.addEventListener('click', () => {
    searchArea.classList.toggle('open');

    if (searchArea.classList.contains('open')) {
      searchInput.focus();
    } else {
      searchInput.value = "";
      filterPerfumes("");
    }
  });

  // Filtrar mientras se escribe
  searchInput.addEventListener('input', (e) => {
    const value = e.target.value.trim().toLowerCase();
    filterPerfumes(value);
  });

function filterPerfumes(query) {
  cards.forEach(card => {
    const name  = (card.dataset.name  || "").toLowerCase();
    const brand = (card.dataset.brand || "").toLowerCase();

    const matches =
      query === "" ||
      name.includes(query) ||
      brand.includes(query);

    card.style.display = matches ? "" : "none";
  });

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
