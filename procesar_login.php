<?php
// procesar_login.php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Saneamiento de datos para evitar inyecciones de código (RNF04)
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (!empty($correo) && !empty($password)) {
        try {
            // Consulta preparada con PDO (Evita SQL Injection)
            $sql = "SELECT id_usuario, nombre, apellido, password, rol FROM \"Usuarios\" WHERE correo = :correo";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['correo' => $correo]);
            $usuario = $stmt->fetch();

            // Verificación del hash de contraseña encriptada (RNF03)
            if ($usuario && password_verify($password, $usuario['password'])) {
                // [RF02]: Cargamos las variables en la sesión del servidor
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre'] = $usuario['nombre'] . ' ' . $usuario['apellido'];
                $_SESSION['rol'] = $usuario['rol'];

                // Redirección exitosa al dashboard principal
                header("Location: inicio.php");
                exit;
            } else {
                // Error de autenticación (Credenciales incorrectas)
                header("Location: login.php?error=1");
                exit;
            }
        } catch (PDOException $e) {
            // En caso de fallo crítico en la BD (RNF07)
            header("Location: login.php?error=db");
            exit;
        }
    }
}
header("Location: login.php");
exit;
?>