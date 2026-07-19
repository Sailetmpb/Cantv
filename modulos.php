<?php
session_start();

// RF01/NEC-01: se cumple con el requisito RF01 que se encarga de la Autenticación de Acceso
// RNF04 /NEC-04: se cumple con el requisito RNF04 encargado de asegurar la integridad restringiendo accesos directos

if (!isset($_SESSION['id_usuario'])) {
    header("Location: portal.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulos del Sistema</title>
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="modulos.css">
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
            <li onclick="irAInicio()">Inicio / Mapa</li>
        </ul>
    </div>

    <div class="main-wrapper">
        <div class="welcome-section">
            <h2>Bienvenido al Selector de Módulos</h2>
            <p>Por favor, seleccione el área de trabajo en la que desea operar hoy.</p>
        </div>

        <div class="modules-grid">
            
            <div class="module-card" onclick="irARiesgos()">
                <div class="module-image">
                    <img src="riesgos.png" alt="Riesgos Operativos" style="width: 270px !important; height: 200px !important;">
                </div>
                <h3>Riesgos Operacionales</h3>
                <p>Gestión, análisis, monitoreo y reporte del mapa de riesgos en la infraestructura de la red.</p>
                <span class="badge active">Acceder</span>
            </div>

            <div class="module-card" onclick="irAMateriales()">
                <div class="module-image">
                    <img src="materiales.png" alt="Gestión de Materiales" style="width: 270px !important; height: 200px !important;">
                </div>
                <h3>Gestión de Materiales</h3>
                <p>Control de inventario, stock de cables, herramientas y repuestos para mantenimiento.</p>
                <span class="badge active">Acceder</span>
            </div>

            <div class="module-card disabled">
                <div class="module-image">
                    <img src="viaticos.png" alt="Despacho y Viáticos" class="grayscale" style="width: 270px !important; height: 200px !important;">
                </div>
                <h3>Despacho y Viáticos</h3>
                <p>Control de despacho de flotas, rutas de mantenimiento de campo y asignación de viáticos.</p>
                <span class="badge disabled-badge">Inhabilitado</span>
            </div>

        </div>
    </div>

    <footer>
        <p>Proyecto realizado para la presentacion de PST II, correspondiente al Trayecto 2 <br> 
            del PNF Informatica de la Universidad Nacional Experimental de las Telecomunicaciones e Informatica</p>
    </footer>

    <script src="modulos.js"></script>
</body>
</html>