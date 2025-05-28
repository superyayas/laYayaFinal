// Barra de buscador

function buscador() {
  const resultados = document.getElementById('resultados');
  const texto      = document.getElementById('buscador').value.trim();

  if (!texto) {
    resultados.style.display = "none"; // ocultamos
    resultados.innerHTML = '';
    return;
  }

  const url = `${window.BASE_URL}includes/buscar_producto.php?nombre=${encodeURIComponent(texto)}`;
  console.log('BUSCANDO URL ABSOLUTA:', url);

  fetch(url)
    .then(res => {
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      return res.text();
    })
    .then(html => {
      resultados.innerHTML = `
        <button onclick="cerrarResultados()" class="btn-cerrar">Cerrar</button>
        ${html}
      `;
      resultados.style.display = "block"; // hace que se muestre
    })
    .catch(err => {
      console.error('Error al buscar:', err);
      resultados.innerHTML = '<p>Error al buscar. Inténtalo de nuevo.</p>';
    });
}

// Nueva función para cerrar el resultado
function cerrarResultados() {
  const resultados = document.getElementById('resultados');
  resultados.style.display = "none";
  resultados.innerHTML = '';
}

// Modal de confirmación para eliminar producto
let formularioActual = null;

document.addEventListener("DOMContentLoaded", () => {
  // Asigna evento a cada formulario de eliminar
  document.querySelectorAll('.form-eliminar').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault(); // Evita el envío automático
      formularioActual = form;
      document.getElementById('modalConfirmacion').style.display = 'flex'; // Mostrar modal
    });
  });

  // Botón confirmar del modal
  const btnConfirmar = document.getElementById('confirmarEliminar');
  if (btnConfirmar) {
    btnConfirmar.addEventListener('click', () => {
      if (formularioActual) formularioActual.submit(); // Envía el formulario
    });
  }
});

//Modal para error de añadir usuario repetido


// Función para cerrar el modal
function cerrarModal() {
  document.getElementById('modalConfirmacion').style.display = 'none';
}

function cerrarResultados() {
  document.getElementById("resultados").style.display = "none";
}