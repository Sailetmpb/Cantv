<?php
// conexion.php

$host = "127.0.0.1"; // O "localhost"
$port = "5432";      // Puerto por defecto de PostgreSQL
$dbname = "riesgos_operativos"; // El nombre que le diste a tu base de datos
$user = "postgres";  // Usuario por defecto de Postgres
$password = "19942801"; // <-- Pon aquí la clave que usas para entrar a HeidiSQL

try {
    // Conexión segura usando PDO (Cumple con RNF04 - Integridad y Seguridad de datos)
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Reportar errores como excepciones
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Retornar datos como arrays asociativos
        PDO::ATTR_EMULATE_PREPARES => false, // Usar consultas preparadas reales de la BD
    ]);
} catch (PDOException $e) {
    // Si la conexión falla, se muestra un mensaje amigable (Cumple con RNF06 y RNF07)
    // Nota: No mostramos $e->getMessage() en producción para no exponer datos del servidor por seguridad.
    die("Error temporal en el sistema. No se pudo establecer la conexión con la base de datos.");
}
?>