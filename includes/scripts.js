
      
//Barra de buscador

function buscador() {
  const resultados = document.getElementById('resultados');
  const texto      = document.getElementById('buscador').value.trim();

  if (!texto) {
    resultados.innerHTML = '<p>Escribe algo para buscar.</p>';
    return;
  }

  // Como window.BASE_URL === '/laYayaFinal/'
  // esto monta: '/laYayaFinal/includes/buscar_producto.php?nombre=Leche'
  const url = `${window.BASE_URL}includes/buscar_producto.php?nombre=${encodeURIComponent(texto)}`;
  console.log('BUSCANDO URL ABSOLUTA:', url);

  fetch(url)
    .then(res => {
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      return res.text();
    })
    .then(html => resultados.innerHTML = html)
    .catch(err => {
      console.error('Error al buscar:', err);
      resultados.innerHTML = '<p>Error al buscar. Inténtalo de nuevo.</p>';
    });
}
