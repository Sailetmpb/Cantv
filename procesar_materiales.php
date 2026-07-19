<?php
session_start();
require_once 'conexion.php'; 

if (!isset($_SESSION['id_usuario'])) {
    header("Location: portal.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $datos = [
            ':nombre_material' => $_POST['nombre_material'],
            ':disponibilidad_material' => $_POST['disponibilidad_material']
        ];

        if (isset($_POST['es_edicion']) && $_POST['es_edicion'] == "1") {
            // Lógica para actualizar
            $sql = 'UPDATE "Materiales" SET 
                    "nombre_material" = :nombre_material, 
                    "disponibilidad_material" = :disponibilidad_material
                    WHERE "codigo_material" = :codigo_material';
            $datos[':codigo_material'] = $_POST['codigo_material'];
        } else {
            // Lógica para insertar
            $sql = 'INSERT INTO "Materiales" 
                    ("nombre_material", "disponibilidad_material") 
                    VALUES (:nombre_material, :disponibilidad_material)';
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($datos);

        header("Location: materiales.php?status=success");
        exit();

    } catch (PDOException $e) {
        echo "Error al guardar: " . $e->getMessage();
    }
}
?>