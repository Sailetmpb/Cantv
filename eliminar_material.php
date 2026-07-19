<?php
require_once 'conexion.php';
if (isset($_GET['codigo'])) {
    $stmt = $pdo->prepare('DELETE FROM "Materiales" WHERE "codigo_material" = :codigo');
    $stmt->execute([':codigo' => $_GET['codigo']]);
}
header("Location: materiales.php");
?>