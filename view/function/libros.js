document.addEventListener("DOMContentLoaded", function () {
  const libros = [
    {
      id: 1,
      titulo: "Cien Años de Soledad",
      precio: 35.00,
      imagen: "https://m.media-amazon.com/images/I/81rk+5DKxHL._AC_UF1000,1000_QL80_.jpg",
    },
    {
      id: 2,
      titulo: "Don Quijote de la Mancha",
      precio: 42.50,
      imagen: "https://m.media-amazon.com/images/I/71UvK9zA0oL._AC_UF1000,1000_QL80_.jpg",
    },
    {
      id: 3,
      titulo: "El Principito",
      precio: 25.00,
      imagen: "https://m.media-amazon.com/images/I/71aFt4+OTOL._AC_UF1000,1000_QL80_.jpg",
    },
    {
      id: 4,
      titulo: "Harry Potter y la Piedra Filosofal",
      precio: 48.90,
      imagen: "https://m.media-amazon.com/images/I/81iqZ2HHD-L._AC_UF1000,1000_QL80_.jpg",
    },
  ];

  const contenedorLibros = document.getElementById("libros_venta");
  const listaCarrito = document.getElementById("lista_carrito");
  const subtotalLabel = document.getElementById("subtotal");
  const igvLabel = document.getElementById("igv");
  const totalLabel = document.getElementById("total");

  let carrito = [];

  // Mostrar libros en tarjetas
  libros.forEach((libro) => {
    const card = document.createElement("div");
    card.className = "card m-2 col-3";
    card.innerHTML = `
      <div class="card-body text-center">
        <img src="${libro.imagen}" alt="${libro.titulo}" width="100%" height="200px">
        <p class="card-text mt-2 fw-bold">${libro.titulo}</p>
        <p class="text-success">$${libro.precio.toFixed(2)}</p>
        <button class="btn btn-primary btn-agregar" data-id="${libro.id}">Agregar</button>
      </div>
    `;
    contenedorLibros.appendChild(card);
  });

  // Agregar al carrito
  contenedorLibros.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-agregar")) {
      const id = parseInt(e.target.getAttribute("data-id"));
      const libro = libros.find((l) => l.id === id);
      const itemCarrito = carrito.find((c) => c.id === id);

      if (itemCarrito) {
        itemCarrito.cantidad++;
      } else {
        carrito.push({ ...libro, cantidad: 1 });
      }

      actualizarCarrito();
    }
  });

  // Eliminar libro del carrito
  listaCarrito.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-eliminar")) {
      const id = parseInt(e.target.getAttribute("data-id"));
      carrito = carrito.filter((item) => item.id !== id);
      actualizarCarrito();
    }
  });

  // Actualizar tabla de carrito
  function actualizarCarrito() {
    listaCarrito.innerHTML = "";
    let subtotal = 0;

    carrito.forEach((item) => {
      const totalItem = item.precio * item.cantidad;
      subtotal += totalItem;

      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td>${item.titulo}</td>
        <td>${item.cantidad}</td>
        <td>$${item.precio.toFixed(2)}</td>
        <td>$${totalItem.toFixed(2)}</td>
        <td><button class="btn btn-danger btn-sm btn-eliminar" data-id="${item.id}">X</button></td>
      `;
      listaCarrito.appendChild(fila);
    });

    const igv = subtotal * 0.18;
    const total = subtotal + igv;

    subtotalLabel.textContent = `$${subtotal.toFixed(2)}`;
    igvLabel.textContent = `$${igv.toFixed(2)}`;
    totalLabel.textContent = `$${total.toFixed(2)}`;
  }

  // Botón de finalizar compra
  document.getElementById("btn_realizar_venta").addEventListener("click", () => {
    if (carrito.length === 0) {
      alert("El carrito está vacío.");
      return;
    }
    alert("¡Compra realizada con éxito! Gracias por tu pedido 📚");
    carrito = [];
    actualizarCarrito();
  });
});
