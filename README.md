# Sistema de Operaciones de Red (Cantv)

Sistema web desarrollado para la gestión y control automatizada de riesgos operativos y materiales. El sistema integra PHP como lenguaje de servidor, JavaScript y CSS para la interfaz, y PostgreSQL como motor de base de datos, garantizando una administración eficiente de la información técnica.

## Tecnologías Utilizadas
- Lenguaje: PHP, JavaScript, CSS.
- Base de Datos: PostgreSQL.
- Herramientas de Gestión: HeidiSQL, XAMPP (Apache), VS Code.

## Requisitos de Instalación
1. Servidor: Instalar y ejecutar Apache desde XAMPP.
2. Base de Datos:
   - Asegurar que PostgreSQL esté instalado.
   - Iniciar el servidor mediante terminal: pg_ctl start -D "C:\postgre\data\" (ajustar ruta según su instalación).
   - Importar el script de base de datos a través de HeidiSQL.
3. Repositorio: Clonar este proyecto dentro de la carpeta htdocs de XAMPP.
4. Configuración: Editar el archivo conexion.php para ajustar las credenciales de su base de datos local.

## Flujo del Sistema
1. portal.php: Bienvenida.
2. login.php: Autenticación (Usuarios creados vía HeidiSQL).
3. Inicio.php: Dashboard principal.
4. modulos.php: Selector de módulos (Riesgos / Materiales).