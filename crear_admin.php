<?php
require __DIR__ . '/controller/conexion.php';

$email = 'admin@admin.com';
$password = 'admin123'; // Cambia esto luego por seguridad
$tipo = 'administrador';

// Hashear la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Verificar si ya existe
$sql_check = "SELECT id FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql_check);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    echo "⚠️ Ya existe un usuario con ese correo.";
} else {
    $sql_insert = "INSERT INTO usuarios (email, password, tipo) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt, "sss", $email, $hashed_password, $tipo);

    if (mysqli_stmt_execute($stmt)) {
        echo "✅ Usuario administrador creado: <strong>$email</strong><br>Contraseña: <strong>$password</strong>";
    } else {
        echo "❌ Error al crear el administrador.";
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
