function toggleMenu() {
    const sidebar = document.getElementById("sidebar");
    const icon = document.querySelector(".menu-icon img");

    // Alterna la clase 'active'
    
    sidebar.classList.toggle("active");

    // Cambia el icono basado en si tiene la clase activa o no

    if (sidebar.classList.contains("active")) {
        icon.src = "close.png";
    } else {
        icon.src = "menu.png";
    }
}

function irAModulos() {
    window.location.href = 'modulos.php';
}
