// js/cart.js

const WPP_NUMBER = "59162113222"; // Tu número

const cart = [];

// Botones y elementos
const addButtons   = document.querySelectorAll(".btn-add-cart");
const oneButtons   = document.querySelectorAll(".btn-wpp-one");
const cartButton   = document.getElementById("cartButton");
const cartCountTag = document.getElementById("cartCount");

// === DETECCIÓN DE PÁGINA (NUEVO) ===
// Leemos la URL para saber si estamos en la sección de DECANTS
const urlParams = new URLSearchParams(window.location.search);
const action    = urlParams.get('a'); // obtenemos el valor de 'a' (index o decants)
const isDecantsPage = (action === 'decants'); // Será true si estamos en decants

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

/* ===========================================================
   1) AGREGAR AL CARRITO (Botón Negro)
   =========================================================== */
addButtons.forEach(btn => {
  btn.addEventListener("click", (e) => {
    const card = e.currentTarget.closest(".perfume-card");
    if (!card) return;

    const name  = card.dataset.name  || "Producto";
    const brand = card.dataset.brand || "";
    // Priorizamos el dato de la tarjeta, si no existe, usamos la detección de URL
    const type  = card.dataset.type  || (isDecantsPage ? 'decant' : 'perfume');

    let fullName = brand ? `${brand} - ${name}` : name;

    // Si estamos en la página de decants (o la tarjeta lo dice), lo marcamos
    if (type === 'decant') {
        fullName += " (DECANT)";
    }

    cart.push(fullName);
    updateCartBadge();

    // Feedback visual
    const originalText = e.currentTarget.textContent;
    e.currentTarget.textContent = "Agregado ✅";
    setTimeout(() => {
      e.currentTarget.textContent = originalText;
    }, 1200);
  });
});

/* ===========================================================
   2) CONSULTAR INDIVIDUAL (Botón Dorado)
   =========================================================== */
oneButtons.forEach(btn => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    const card = e.currentTarget.closest(".perfume-card");
    if (!card) return;

    const name  = card.dataset.name  || "Producto";
    const brand = card.dataset.brand || "";
    // Detectamos tipo
    const type  = card.dataset.type  || (isDecantsPage ? 'decant' : 'perfume');

    const fullName = brand ? `${brand} - ${name}` : name;

    // Lógica del mensaje basada en la URL o el tipo
    let productoTexto = "el perfume";
    if (type === 'decant') {
        productoTexto = "el decant";
    }

    const msg = `Hola, me interesa ${productoTexto}:\n\n${fullName}\n\n¿Está disponible?`;
    openWhatsAppWithMessage(msg);
  });
});

/* ===========================================================
   3) ENVIAR TODO EL CARRITO (Botón Flotante)
   =========================================================== */
if (cartButton) {
  cartButton.addEventListener("click", () => {
    if (cart.length === 0) {
      alert("No tienes productos en el carrito todavía.");
      return;
    }

    const lines = cart.map((p, i) => `${i + 1}. ${p}`).join("\n");

    // Si estamos en la página de decants, cambiamos el saludo también
    let intro = "Hola, me interesan estos perfumes/productos:";
    if (isDecantsPage) {
        intro = "Hola, me interesan estos DECANTS:";
    }

    const msg = `${intro}\n\n${lines}\n\n¿Me podrías pasar precios y disponibilidad?`;

    openWhatsAppWithMessage(msg);
  });
}

// Inicializar badge
updateCartBadge();