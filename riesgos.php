<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// [RF01 / NEC-01]: Autenticación de Acceso
// [RNF04 / NEC-04]: Asegurar la integridad restringiendo accesos directos
if (!isset($_SESSION['id_usuario'])) {
    header("Location: portal.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Riesgos Operacionales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="riesgos.css">
</head>
<body>
<div class= "container">
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
            <li onclick="location.href='inicio.php'">Volver al Inicio</li>
        </ul>
    </div>
    
    <main class="main-wrapper">
        <section class="welcome-section">
            <h2 style="text-align: center; color: rgb(26,26,158); font-weight: bold;">Gestión de Riesgos Operacionales</h2>
        </section>

    <form action="procesar_riesgo.php" method="POST">
        <input type="hidden" name="es_edicion" id="es_edicion" value="0">

        <!--Formulario con etiquetas para las entradas de los riesgos -->

        <div class="formulario-riesgos" method="POST" action="procesar_riesgo.php">

            <div class="grid-container">
                <label>Número de Riesgo: 
                    <input type="text" name="numero_riesgo" value="Automático" readonly class="input-disabled">
                </label>
            </div>

            <div class="grid-container">
                <label>Raíz del Riesgo: 
                    <select name="raiz_riesgo" required>
                        <option value="" disabled selected>Selecciona una opción...</option>
                        <option value="Atenuación">Atenuación</option>
                        <option value="Vandalismo o hurto">Vandalismo o hurto</option>
                        <option value="Desastres naturales">Desastres naturales</option>
                        <option value="Daños por obras civiles de terceros">Daños por obras civiles de terceros</option>
                        <option value="Por definir">Por definir</option>
                    </select>
                </label>
            </div>

            <div class="grid-container">
                <label>Tipo de Ejecución:
                    <select name="tipo_ejecucion" required>
                        <option value="" disabled selected>Selecciona una opción...</option>
                        <option value="Esfuerzo propio">Esfuerzo propio</option>
                        <option value="Contratación">Contratación</option>
                        <option value="Alianzas">Alianzas</option>
                        <option value="Servicios infraestructura">Servicios infraestructura</option>
                        <option value="Por definir">Por definir</option>
                    </select>
                </label>
            </div>

            <div class="grid-container">
                <label>Nº Incidente: 
                    <input type="text" name="numero_incidente" required placeholder="Escriba el número">
                </label>
            </div>

            <div class="grid-container">
                <label>Afectación: 
                    <select name="afectacion" required>
                        <option value="" disabled selected>Selecciona una opción...</option>
                        <option value="Oriente I, RII">Oriente I, RII</option>
                        <option value="Red de Integración Internacional">Red de Integración Internacional</option>
                        <option value="Red ME OPSUT">Red ME OPSUT</option>
                        <option value="Anillos Los Andes y RI">Anillos Los Andes y RI</option>
                        <option value="Anillo OCC1, OCC2">Anillo OCC1, OCC2</option>
                        <option value="OPSUT">OPSUT</option>
                        <option value="Anillo Oriente">Anillo Oriente</option>
                    </select>
                </label>
            </div>

            <div class="grid-container">
                <label>Planificación Inicial: 
                    <select name="planificacion_inicial" required>
                        <option value="" disabled selected>Selecciona una opción...</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                </label>
            </div>

            <div class="grid-container">
                <label>Región: 
                    <select id="region" name="region" onchange="cargarEstados()" required>
                        <option value="" disabled selected>Selecciona una opción...</option>
                    </select>
                </label>
            </div>

            <div class="grid-container">
                <label>Tramos: <input type="text" name="tramos" required></label>
            </div>

            <div class="grid-container">
                <label>Mes de Ingreso: 
                    <select name="mes_ingreso" required>
                        <option value="" disabled selected>Selecciona una opción...</option>

                        <?php 
                        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                        foreach($meses as $m) echo "<option value='$m'>$m</option>";
                        ?>
                    </select>
                </label>
            </div>

            <div class="grid-container">
                <label>Estado: 
                    <select name="estado" id="estado" required>
                        <option value="" disabled selected>Selecciona una opción...</option>
                    </select>
                </label>
            </div>

            <div class="grid-container">
                <label>Prioridad: 
                    <select name="prioridad" required>
                        <option value="" disabled selected>Selecciona una opción...</option>
                        <option value="A1">A1</option>
                        <option value="A2">A2</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </label>
            </div>

            <div class="grid-container">
                <label>¿Requiere material?: 
                    <select name="disponibilidad_material">
                        <option value="" disabled selected>Selecciona una opción...</option>
                        <option value="Sí">Sí</option>
                        <option value="No">No</option>
                    </select>
                </label>
            </div>       
                
            <!-- Botones de accion para guardar y exportar tabla a formato Excel -->

            <div class="acciones">
                <button type="submit" id="btn-guardar" class="btn-guardar">Guardar Riesgo</button>
                <button type="button" class="btn-exportar" onclick="exportarExcel()">Descargar  en Excel</button>
            </div>
        </div>
    </form>

    <!-- Contenedor para el boton de buscador/filtrar dato -->

        <div class="contenedor-buscador" style="margin: 20px 0; padding: 15px; background-color: #f4f4f4; display: flex; gap: 10px; align-items: center;">
            <input type="text" id="id_busqueda" placeholder="Escribe el Nº de Riesgo..." style="padding: 10px; flex: 1;">
            <button type="button" class="btn-buscar" id="btn_buscar" onclick="buscarParaEditar()" style="padding: 10px 20px;cursor:pointer; background-color: rgb(31, 114, 194); border-radius: 6px; border: none; color: white;">Buscar Riesgo</button>
        </div>
        <!-- Campo para poder filtrar -->
            <?php
        // Configuración de conexión (se deben ajustar los datos del servidor para usarlo en otro equipo)
        $host = "localhost";
        $dbname = "riesgos_operativos";
        $user = "postgres"; // Cambia por tu usuario
        $password = "19942801"; // Cambia por tu contraseña

        try {
            $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Consulta los datos
            $stmt = $pdo->query('SELECT * FROM "RiesgosOperacionesRed" ORDER BY "numero_riesgo" DESC');
            $riesgos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        <!-- Tbla para mostrar los riesgos operativos guardados en la base de datos -->

        <div class="table-container">
        <table class="data-table" id="tablaRiesgos">
            <thead>
                <tr>
                    <th>ID Riesgo</th>
                    <th>Nº Incidente</th>
                    <th>Región</th>
                    <th>Estado</th>
                    <th>Raíz del riesgo</th>
                    <th>Afectación</th>
                    <th>Tramos</th>
                    <th>Prioridad</th>
                    <th>Tipo de ejecución</th>
                    <th>Planificación inicial</th>
                    <th>Mes de ingreso</th>
                    <th>ID Usuario</th>
                    <th>Material</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($riesgos)): ?>
                    <?php foreach ($riesgos as $fila): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['numero_riesgo']); ?></td>
                        <td><?php echo htmlspecialchars($fila['numero_incidente']); ?></td>
                        <td><?php echo htmlspecialchars($fila['region']); ?></td>
                        <td><?php echo htmlspecialchars($fila['estado']); ?></td>
                        <td><?php echo htmlspecialchars($fila['raiz_riesgo']); ?></td>
                        <td><?php echo htmlspecialchars($fila['afectacion']); ?></td>
                        <td><?php echo htmlspecialchars($fila['tramos']); ?></td>
                        <td><?php echo htmlspecialchars($fila['prioridad']); ?></td>
                        <td><?php echo htmlspecialchars($fila['tipo_ejecucion']); ?></td>
                        <td><?php echo htmlspecialchars($fila['planificacion_inicial']); ?></td>
                        <td><?php echo htmlspecialchars($fila['mes_ingreso']); ?></td>
                        <td><?php echo htmlspecialchars($fila['id_usuario']); ?></td>
                        <td><?php echo ($fila['disponibilidad_material'] === 'Sí') ? 'Sí' : 'No'; ?></td>
                        <td>
                            <button type= "button" class="btn-eliminar" onclick="eliminarRiesgo(<?php echo $fila['numero_riesgo']; ?>)" title="Elimnar Registro">
                            <img src="eliminar.png" alt="Eliminar" style="width: 20px; height:20px;"d>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="13">No hay registros almacenados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </main>

    <footer>
        <p>Proyecto realizado para la presentacion de PST II, correspondiente al Trayecto 2 <br> 
            del PNF Informatica de la Universidad Nacional Experimental de las Telecomunicaciones e Informatica</p>
    </footer>

    <script src="riesgos.js"></script>
</div>
</body>
</html>