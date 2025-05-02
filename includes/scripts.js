const items = ["Manzana", "Banana", "Naranja", "Uva", "Pera", "Sandía"];
      
//Barra de buscador

function buscador() {
    // Cambia '#buscador' por el selector real de tu input
    const buscadorInput = document.querySelector('#buscador');
    if (!buscadorInput) {
      console.error('No se encontró el <input> con selector "#buscador"');
      return;
    }
  
    // Aquí ya es seguro leer .value
    const texto = buscadorInput.value.trim();
    if (texto === '') {
      console.log('El buscador está vacío.');
    } else {
      // Lógica de búsqueda…
      console.log('Buscando:', texto);
    }
  }