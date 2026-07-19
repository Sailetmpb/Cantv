<?php
// crear_usuario.php
require_once 'conexion.php';

echo "<h2>🔧 Verificador y Creador de Usuarios de Prueba</h2>";

try {
    // 1. Verificamos la longitud de la columna password por seguridad
    // (Bcrypt necesita mínimo 60 caracteres)
    $stmt = $pdo->query("
        SELECT character_maximum_length 
        FROM information_schema.columns 
        WHERE table_name = 'Usuarios' AND column_name = 'password'
    ");
    $colInfo = $stmt->fetch();
    
    if ($colInfo && $colInfo['character_maximum_length'] < 60 && $colInfo['character_maximum_length'] !== null) {
        echo "<p style='color:red;'>⚠️ <strong>¡ALERTA!:</strong> Tu columna 'password' tiene un límite de " . $colInfo['character_maximum_length'] . " caracteres. ¡La clave se está recortando y por eso no te deja entrar!</p>";
        echo "<p><em>Solución: Ejecuta en HeidiSQL: <code>ALTER TABLE \"Usuarios\" ALTER COLUMN password TYPE VARCHAR(255);</code> y luego recarga esta página.</em></p>";
        exit;
    }

    // 2. Definimos las contraseñas reales y las encriptamos en caliente
    $clavePlana = "admin123";
    $claveEncriptada = password_hash($clavePlana, PASSWORD_BCRYPT);

    // 3. Limpiamos registros anteriores para evitar errores de duplicidad
    $pdo->exec("DELETE FROM \"Usuarios\" WHERE correo IN ('sailet.admin@cantv.net', 'carlos.admin@empresa.com')");

    // 4. Insertamos tu usuario administrador (Sailet)
    $sqlSailet = "INSERT INTO \"Usuarios\" (nombre, apellido, correo, telefono, password, rol) 
                  VALUES (:nombre, :apellido, :correo, :telefono, :password, :rol)";
    
    $stmtSailet = $pdo->prepare($sqlSailet);
    $stmtSailet->execute([
        'nombre'    => 'Sailet',
        'apellido'  => 'Portales',
        'correo'    => 'sailet.admin@cantv.net',
        'telefono'  => '+584120000000',
        'password'  => $claveEncriptada,
        'rol'       => 'Administrador'
    ]);

    // 5. Insertamos el de Carlos
    $stmtCarlos = $pdo->prepare($sqlSailet);
    $stmtCarlos->execute([
        'nombre'    => 'Carlos',
        'apellido'  => 'Pérez',
        'correo'    => 'carlos.admin@empresa.com',
        'telefono'  => '+584120000001',
        'password'  => $claveEncriptada,
        'rol'       => 'Administrador'
    ]);

    echo "<p style='color:green; font-weight:bold;'>✅ ¡Usuarios creados con éxito en la base de datos!</p>";
    echo "<p>Ya puedes iniciar sesión con cualquiera de estas cuentas usando la contraseña: <strong>$clavePlana</strong></p>";
    echo "<ul>
            <li><strong>Correo 1:</strong> sailet.admin@cantv.net</li>
            <li><strong>Correo 2:</strong> carlos.admin@empresa.com</li>
          </ul>";

} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Error al insertar usuarios: " . $e->getMessage() . "</p>";
}
?>