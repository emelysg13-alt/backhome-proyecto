window.addEventListener('load', () => {
    const loader = document.getElementById('loader-wrapper');
    
    // Le añadimos la clase para el efecto de desaparición
    loader.classList.add('loader-hidden');
    
    // Opcional: Eliminar el elemento del DOM después de la transición
    loader.addEventListener('transitionend', () => {
        loader.remove();
    });
});