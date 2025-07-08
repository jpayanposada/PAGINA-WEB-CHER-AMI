<?php
// Mostrar todos los errores (útil en desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir archivo de conexión a la base de datos
require __DIR__ . '/controller/conexion.php';

// Iniciar o reanudar la sesión
session_start();

// Si el usuario no está logueado, limpiar y reiniciar la sesión
if (!isset($_SESSION['loggedin'])) {
    session_unset();
    session_destroy();
    session_start();
}

// Control de inactividad: cerrar sesión si han pasado más de 24 horas (86400 segundos)
$inactividad = 86400;
if (isset($_SESSION["timeout"])) {
    if (time() - $_SESSION["timeout"] > $inactividad) {
        session_unset();
        session_destroy();
        header("Location: login.php?timeout=1"); // Redirige si la sesión expiró
        exit;
    }
}
$_SESSION["timeout"] = time(); // Actualiza el tiempo de actividad

// Variables para almacenar datos y errores del formulario
$username = $password = "";
$username_err = $password_err = "";

// Procesar el formulario cuando se envía por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar el campo de correo electrónico
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingresa el correo.";
    } elseif (!filter_var(trim($_POST["username"]), FILTER_VALIDATE_EMAIL)) {
        $username_err = "Correo inválido.";
    } else {
        $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
    }

    // Validar el campo de contraseña
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingresa la contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Si no hay errores, verificar las credenciales en la base de datos
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, email, password FROM usuarios WHERE email = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Asocia el parámetro al statement
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            // Ejecuta la consulta
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                // Verifica si existe el usuario
                if (mysqli_stmt_num_rows($stmt) === 1) {
                    // Asocia los resultados a variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        // Verifica la contraseña
                        if (password_verify($password, $hashed_password)) {
                            // Autenticación correcta: inicia sesión y redirige
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['email'] = $email;

                            header("Location: dashboard_admin.php");
                            exit;
                        } else {
                            // Contraseña incorrecta
                            $password_err = "Contraseña incorrecta.";
                        }
                    }
                } else {
                    // No se encontró el usuario
                    $username_err = "No se encontró una cuenta con ese correo.";
                }
            } else {
                // Error al ejecutar la consulta
                echo "Error al conectar con la base de datos.";
            }
            // Cierra el statement
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap y estilos personalizados -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>

<!-- Barra superior con logo -->
<div>
    <div class="container-fluid topbar-fijo row align-items-center px-xl-5">
        <div class="col-lg-12 d-flex justify-content-center">
            <a href="index.php" class="text-decoration-none">
                <img src="img/logo-horizontal.png" alt="" style="height: 7em; margin-left: 15px; margin-right: 12px; border-radius: 8px;">
            </a>
        </div>
    </div>
</div>
<body>
    <!-- Contenedor principal del formulario de login -->
    <div class="container d-flex align-items-center justify-content-center min-vh-100" style="background: var(--fondo-login, #f8f9fa);">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
            <h3 class="text-center mb-4" style="color: var(--color-principal, rgb(207, 120, 120));">Administrador - Iniciar Sesión</h3>

            <!-- Mensaje si la sesión expiró -->
            <?php if (isset($_GET['timeout'])): ?>
                <div class="alert alert-warning">Tu sesión ha expirado. Inicia sesión nuevamente.</div>
            <?php endif; ?>

            <!-- Formulario de inicio de sesión -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label">Correo electrónico</label>
                    <input type="email" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>" required>
                    <div class="invalid-feedback"><?php echo $username_err; ?></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" required>
                    <div class="invalid-feedback"><?php echo $password_err; ?></div>
                </div>

                <button type="submit" class="btn w-100" style="background: var(--color-principal,rgb(207, 120, 120)); color: #fff;">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>
