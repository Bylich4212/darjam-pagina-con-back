// js/cart.js

const WPP_NUMBER = "59175575407"; // <- poné tu número sin el +

const cart = [];

// Botones
const addButtons   = document.querySelectorAll(".btn-add-cart");
const oneButtons   = document.querySelectorAll(".btn-wpp-one");
const cartButton   = document.getElementById("cartButton");
const cartCountTag = document.getElementById("cartCount");

function updateCartBadge() {
  if (!cartCountTag) return;
  cartCountTag.textContent = cart.length;
  cartCountTag.style.display = cart.length > 0 ? "inline-flex" : "none";
}

function openWhatsAppWithMessage(message) {
  const encoded = encodeURIComponent(message);
  const url = `https://wa.me/${WPP_NUMBER}?text=${encoded}`;
  window.open(url, "_blank");
}

/* ========== 1) Agregar al carrito ========== */
addButtons.forEach(btn => {
  btn.addEventListener("click", (e) => {
    const card = e.currentTarget.closest(".perfume-card");
    if (!card) return;

    const name  = card.dataset.name  || "Perfume sin nombre";
    const brand = card.dataset.brand || "";

    const fullName = brand ? `${brand} - ${name}` : name;

    cart.push(fullName);
    updateCartBadge();

    // feedback rápido
    e.currentTarget.textContent = "Agregado ✅";
    setTimeout(() => {
      e.currentTarget.textContent = "Agregar al carrito";
    }, 1200);
  });
});

/* ========== 2) Consultar SOLO este perfume ========== */
oneButtons.forEach(btn => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    const card = e.currentTarget.closest(".perfume-card");
    if (!card) return;

    const name  = card.dataset.name  || "Perfume sin nombre";
    const brand = card.dataset.brand || "";

    const fullName = brand ? `${brand} - ${name}` : name;

    const msg = `Hola, me interesa el perfume:\n\n${fullName}\n\n¿Está disponible?`;
    openWhatsAppWithMessage(msg);
  });
});

/* ========== 3) Enviar TODO el carrito por WhatsApp ========== */
if (cartButton) {
  cartButton.addEventListener("click", () => {
    if (cart.length === 0) {
      alert("No tienes perfumes en el carrito todavía.");
      return;
    }

    const lines = cart.map((p, i) => `${i + 1}. ${p}`).join("\n");

    const msg = `Hola, me interesan estos perfumes:\n\n${lines}\n\n¿Me podrías pasar precios y disponibilidad?`;

    openWhatsAppWithMessage(msg);
  });
}

// Ocultar badge al inicio
updateCartBadge();
