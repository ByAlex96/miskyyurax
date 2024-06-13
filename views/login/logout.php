<?php
session_start();

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio
header('Location: /miskyyurax/index.php');

// Termina la ejecución del script
exit;
?>


