<?php
// Asegurarse de que no haya salida antes de esta función
function iniciar_sesion() {
    // Verificar si la sesión ya está activa para no iniciarla dos veces
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Iniciar la sesión inmediatamente
iniciar_sesion();
?>