<?php
function configurar_seguridad_sesion()
{
    // Impide que la cookie de sesión sea accesible por JavaScript
    ini_set('session.cookie_httponly', 1);

    // Garantiza que la cookie de sesión solo se envíe a través de HTTPS
    // Solo si usas HTTPS
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        ini_set('session.cookie_secure', 1);
    }

    // Habilita el modo estricto de sesión
    ini_set('session.use_strict_mode', 1);
}

configurar_seguridad_sesion();
?>