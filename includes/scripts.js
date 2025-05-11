
      
//Barra de buscador

function buscador() {
  const inputBuscar = document.getElementById('buscador');
  const resultados = document.getElementById('resultados');
  const texto = inputBuscar.value.trim();

  if (!texto) {
    resultados.innerHTML = '<p>Escribe algo para buscar.</p>';
    return;
  }

  fetch('buscar_producto.php?nombre=' + encodeURIComponent(texto))
    .then(res => res.text())
    .then(html => {
      resultados.innerHTML = html;
    })
    .catch(err => {
      console.error('Error al buscar:', err);
      resultados.innerHTML = '<p>Error al buscar. Inténtalo de nuevo.</p>';
    });
}