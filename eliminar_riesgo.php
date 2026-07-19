<?php
require_once 'conexion.php';

$id = $_GET['id'];
$stmt = $pdo->prepare('DELETE FROM "RiesgosOperacionesRed" WHERE "numero_riesgo" = :id');

try {
    $stmt->execute([':id' => $id]);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>