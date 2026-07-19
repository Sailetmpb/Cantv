<?php
session_start();

// RF01/NEC-01:  se cumple con el requisito RF01 que se encarga de la Autenticación de Acceso
// RNF04/NEC-04: se cumple con el requisito RNF04 encargado de asegurar la integridad restringiendo accesos directos
if (!isset($_SESSION['id_usuario'])) {
    header("Location: portal.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <nav id="menu" class="menu">
            <div class="menu-icon" onclick="toggleMenu()">
                <img src="menu.png" alt="Menu">
            </div>
            
            <div class="logo">
                <img src="cantv.png" alt="Logo">
                <span class="Titulo">PORTAL MANTENIMIENTO</span>
            </div>

            <div class="login-icon" style="display: flex; align-items: center;">
                <span class="user-info-header">
                    <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong> 
                    (<?php echo htmlspecialchars($_SESSION['rol']); ?>)
                </span>
                <a href="logout.php" class="logout-btn-header" title="Cerrar Sesión">
                    <img src="login.png" alt="Cerrar Sesión" style="filter: hue-rotate(140deg);">
                </a>
            </div>
        </nav>
    </header>

    <div id="sidebar" class="sidebar">
        <button class="button" onclick="toggleMenu()">
            <img src="close.png" alt="close">
        </button>
        <ul>
            <li onclick="irAModulos()">
                Sistema de Riesgos Operacionales de la RED
            </li>
        </ul>
    </div>
    
    <div class="main-wrapper">
        <section>
            <div class="cuadro">
                <p>Mapa interactivo de Riesgos Operacionales De La Red</p>
            </div>
            <div class="mapa">
                <img src="Mapa.png" alt="mapa">
            </div>
        </section>
    </div>

    <footer>
        <p>Proyecto realizado para la presentacion de PST II, correspondiente al Trayecto 2 <br> 
            del PNF Informatica de la Universidad Nacional Experimental de las Telecomunicaciones e Informatica</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>