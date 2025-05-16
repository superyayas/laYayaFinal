
      
//Barra de buscador

function buscador() {
  const inputBuscar = document.getElementById('buscador');
  const resultados  = document.getElementById('resultados');
  const texto       = inputBuscar.value.trim();

  if (!texto) {
    resultados.innerHTML = '<p>Escribe algo para buscar.</p>';
    return;
  }

  // Montamos la URL relativa a index.php,
  // apuntando a la carpeta `includes/`.
  const urlRelativa = 'includes/buscar_producto.php?nombre=' + encodeURIComponent(texto);
  console.log('BUSCANDO URL RELATIVA:', urlRelativa);

  fetch(urlRelativa)
    .then(res => {
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      return res.text();
    })
    .then(html => {
      resultados.innerHTML = html;
    })
    .catch(err => {
      console.error('Error al buscar:', err);
      resultados.innerHTML = '<p>Error al buscar. Inténtalo de nuevo.</p>';
    });
}


