/* Abre y cierra la barra*/

function toggleMenu() {
    var sidebar = document.getElementById("sidebar");
    if (sidebar.style.display === "block" || sidebar.classList.contains("open")) {
        sidebar.style.display = "none";
        sidebar.classList.remove("open");
    } else {
        sidebar.style.display = "block";
        sidebar.classList.add("open");
    }
}

/* Navegación de botones*/

function irAInicio() {
    window.location.href = 'Inicio.php';
}

function irARiesgos() {
    window.location.href = 'riesgos.php';
}

function irAMateriales() {
    window.location.href = 'materiales.php';
}