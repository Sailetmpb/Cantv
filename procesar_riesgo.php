<?php
session_start();
require_once 'conexion.php'; 

if (!isset($_SESSION['id_usuario'])) {
    header("Location: portal.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Preparamos los datos base que siempre se envían
        $datos = [
            ':numero_incidente' => $_POST['numero_incidente'],
            ':region' => $_POST['region'],
            ':estado' => $_POST['estado'],
            ':raiz_riesgo' => $_POST['raiz_riesgo'],
            ':tramos' => $_POST['tramos'],
            ':afectacion' => $_POST['afectacion'],
            ':prioridad' => $_POST['prioridad'],
            ':tipo_ejecucion' => $_POST['tipo_ejecucion'],
            ':planificacion_inicial' => $_POST['planificacion_inicial'],
            ':mes_ingreso' => $_POST['mes_ingreso'],
            ':id_usuario' => $_SESSION['id_usuario'],
            ':disponibilidad_material' => $_POST['disponibilidad_material']
        ];

        if (isset($_POST['es_edicion']) && $_POST['es_edicion'] == "1") {
            // Lógica para actualizar (sin la coma extra antes del WHERE)
            $sql = 'UPDATE "RiesgosOperacionesRed" SET 
                    "numero_incidente" = :numero_incidente, "region" = :region, "estado" = :estado,  
                    "raiz_riesgo" = :raiz_riesgo, "tramos" = :tramos, "afectacion" = :afectacion, 
                    "prioridad" = :prioridad, "tipo_ejecucion" = :tipo_ejecucion, 
                    "planificacion_inicial" = :planificacion_inicial, "mes_ingreso" = :mes_ingreso, 
                    "id_usuario" = :id_usuario, disponibilidad_material = :disponibilidad_material
                    WHERE "numero_riesgo" = :numero_riesgo';
            
            // Agregamos el ID necesario para el UPDATE
            $datos[':numero_riesgo'] = $_POST['numero_riesgo'];
        } else {
            // Lógica para insertar
            $sql = 'INSERT INTO "RiesgosOperacionesRed" 
                    ("numero_incidente", "region", "estado", "raiz_riesgo", "tramos", "afectacion", "prioridad", "tipo_ejecucion", "planificacion_inicial", "mes_ingreso", "id_usuario", "disponibilidad_material") 
                    VALUES (:numero_incidente, :region, :estado, :raiz_riesgo, :tramos, :afectacion, :prioridad, :tipo_ejecucion, :planificacion_inicial, :mes_ingreso, :id_usuario, :disponibilidad_material)';
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($datos);

        header("Location: riesgos.php?status=success");
        exit();

    } catch (PDOException $e) {
        echo "Error al guardar: " . $e->getMessage();
    }
}
?>