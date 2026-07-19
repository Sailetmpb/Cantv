<?php
header('Content-Type: application/json'); 
require_once 'conexion.php';

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM "RiesgosOperacionesRed" WHERE "numero_riesgo" = :id');
$stmt->execute([':id' => $id]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    echo json_encode($resultado);
} else {
    echo json_encode(['error' => 'No encontrado']);
}
?>