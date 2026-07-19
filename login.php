<?php
// login.php
session_start();
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
    <title>Iniciar Sesión - Gestión de Riesgos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container login-container">
    <div class="card shadow-lg border-0 login-card">
        <div class="card-header text-white text-center py-4">
            <h4 class="mb-0 fw-bold">Autenticación de Acceso</h4>
        </div>
        <div class="card-body p-4">
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center" role="alert" id="error-alert">
                    Usuario o contraseña incorrectos.
                </div>
            <?php endif; ?>

            <form action="procesar_login.php" method="POST" id="loginForm">
                <div class="mb-3">
                    <label for="correo" class="form-label fw-semibold">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="ejemplo@cantv.com.ve" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</div>

    <script src="login.js"></script>
</body>
</html>