<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="riesgos.css"> <!-- Usamos tu mismo CSS -->
    <title>Gestión de Materiales - Cantv</title>
</head>
<body>

<header>
    <nav>
        <div class="logo"><img src="logo.png" alt="Logo"><span class="Titulo">GESTIÓN DE MATERIALES</span></div>
    </nav>
</header>

<div class="main-wrapper">
    <!-- Formulario con la estructura de riesgos.css -->
    <form action="procesar_materiales.php" method="POST" class="formulario-riesgos">
        <input type="hidden" name="es_edicion" id="es_edicion" value="0">
        <input type="hidden" name="codigo_material" id="codigo_material">
        
        <div class="grid-container">
            <label>Nombre del Material:</label>
            <input type="text" name="nombre_material" id="nombre_material" required>
        </div>

        <div class="grid-container">
            <label>Disponibilidad:</label>
            <select name="disponibilidad_material" id="disponibilidad_material">
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="acciones">
            <button type="submit" class="btn-guardar">Guardar Material</button>
        </div>
    </form>

    <!-- Tabla con el estilo de data-table -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'conexion.php';
                $stmt = $pdo->query('SELECT * FROM "Materiales"');
                foreach ($stmt as $fila): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['codigo_material']); ?></td>
                    <td><?php echo htmlspecialchars($fila['nombre_material']); ?></td>
                    <td><?php echo ($fila['disponibilidad_material'] === 'Sí') ? 'Sí' : 'No'; ?></td>
                    <td>
                        <button class="btn-eliminar" onclick="editarMaterial(<?php echo $fila['codigo_material']; ?>, '<?php echo $fila['nombre_material']; ?>', '<?php echo $fila['disponibilidad_material']; ?>')">
                            <img src="editar.png" width="20px">
                        </button>
                        <button class="btn-eliminar" onclick="eliminarMaterial(<?php echo $fila['codigo_material']; ?>)">
                            <img src="eliminar.png" width="20px">
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="materiales.js"></script>
</body>
</html>