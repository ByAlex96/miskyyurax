<?php 

// Verificar conexión
if ($conn->connect_error) {
    echo "No se ha logrado conectar con el servidor. Serás redirigido a la página principal en 2 segundos.";
    echo "<a href='/miskyyurax/index.php'>regresa al inicio</a>";
    // JavaScript para redireccionar automáticamente
    echo "<script>
            setTimeout(function(){
                window.location.href = '/miskyyurax/index.php';
            },  2000);
        </script>";
    exit();
}

// Verificar que el usuario esté autenticado y que 'usuario' esté en la sesión
if (!isset($_SESSION['usuario'])) {
    echo "Usuario no autenticado. Serás redirigido a la página principal en 2 segundos.";
    echo "<a href='/miskyyurax/index.php'>regresa al inicio</a>";
    // JavaScript para redireccionar automáticamente
    echo "<script>
            setTimeout(function(){
                window.location.href = '/miskyyurax/index.php';
            }, 2000);
        </script>";
    exit();
}

?>
