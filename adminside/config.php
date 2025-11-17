<?php
// Configuración de conexión a la base de datos
$host = "localhost";          // Servidor MySQL
$user = "appuser";            // Usuario que creaste para la app
$password = "app1234";        // Contraseña del usuario appuser
$database = "user_db";        // Nombre de la base de datos

// Crear conexión
$conn = mysqli_connect($host, $user, $password, $database);

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Establecer codificación de caracteres
mysqli_set_charset($conn, "utf8");
?>
