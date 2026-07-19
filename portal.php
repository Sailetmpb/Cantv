<?php
session_start();
// si el usuario ya tiene una sesión activa, lo mandamos directo al inicio
if (isset($_SESSION['id_usuario'])) {
    header("Location: inicio.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Portal de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="portal.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="welcome-card">
            <div class="mb-4">
                <i class="chart-icon bi bi-bar-chart-fill"></i>
            </div>
            
            <h1 class="display-4 fw-bold mb-3">Portal de Gestión de Riesgos operativos</h1>
            <p class="lead mb-4">
                Plataforma centralizada para el análisis, control y mitigación de riesgos operativos de la red.
            </p>
            
            <hr class="my-4 white-line">
            
            <div class="d-grid gap-2 col-md-6 mx-auto">
                <button class="btn btn-primary" onclick="irAlLogin()">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar al Portal
                </button>
            </div>
        </div>
    </div>
</div>

    <script src="portal.js"></script>
</body>
</html>