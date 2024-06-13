<?php
// Detectar si ha habido un error en los formularios
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    echo "<div class='alert alert-danger' role='alert'>" . htmlspecialchars($_SESSION['error']) . "</div>";
    $_SESSION['error'] = ''; // Limpiar los errores después de mostrarlos
}

// Detectar si ha habido un cambio exitoso en los formularios
if (isset($_SESSION['cambio']) && $_SESSION['cambio'] === TRUE) {
    echo "<div class='alert alert-success' role='alert'>¡Los cambios se han guardado correctamente!</div>";
    $_SESSION['cambio'] = FALSE; // Limpiar el mensaje de éxito después de mostrarlo
}

// Detectar si se ha registrado una cita exitosamente
if (isset($_SESSION['cita']) && $_SESSION['cita'] === TRUE) {
    echo "<div class='alert alert-success' role='alert'>¡Se ha registrado la cita exitosamente!</div>";
    $_SESSION['cita'] = ''; // Limpiar el mensaje de éxito después de mostrarlo
}
