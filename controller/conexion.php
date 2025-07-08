<?php
$host = 'localhost';
$db = 'cher_ami_web_site';  // Tu base de datos
$user = 'root';           // Usuario de la base de datos (por defecto en XAMPP)
$pass = '';               // Contraseña (en XAMPP normalmente está vacía)

// Crear conexión
$conn = mysqli_connect($host, $user, $pass, $db);

// Verificar conexión
if (!$conn) {
    die("❌ Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>
