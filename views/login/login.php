<?php
session_start();

include '../../scripts/bd.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener y validar los datos del formulario
$user = trim(strip_tags(htmlentities($_POST['usuario'])));
$pass = trim(strip_tags(htmlentities($_POST["password"])));
$fecha_login = date('Y-m-d H:i:s');

// Preparar la declaración SQL para seleccionar la información de login
$stmt = $conn->prepare('SELECT idUsuarioFK, password, role FROM logins WHERE usuario = ?');
$stmt->bind_param('s', $user);
$stmt->execute();
$stmt->store_result();

// Verificar si se encontró el usuario
if ($stmt->num_rows > 0) {
    // Asociar los resultados de la consulta a variables
    $stmt->bind_result($idUsuarioFK, $hashed_pass, $role);
    $stmt->fetch();

    // Verificar la contraseña
    if (password_verify($pass, $hashed_pass)) {
        session_regenerate_id();

        $_SESSION['valido'] = TRUE;

        // Obtener información adicional del usuario
        $stmt->close();
        $stmt = $conn->prepare('SELECT nombre FROM usuarios WHERE IdUsuario = ?');
        $stmt->bind_param('i', $idUsuarioFK);
        $stmt->execute();
        $stmt->bind_result($nombre);
        $stmt->fetch();

        $_SESSION['nombre'] = $nombre;
        $_SESSION['usuario'] = $idUsuarioFK;
        $_SESSION['role'] = $role;

        // Insertar en la tabla logins el nuevo inicio de sesión
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO logins (idUsuarioFK, fecha_login, usuario, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $idUsuarioFK, $fecha_login, $user, $hashed_pass, $role);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            // La inserción fue exitosa
            echo "<script>
                alert('Inicio de sesión exitoso!');
                setTimeout(function(){
                    window.location.href = '/miskyyurax/index.php';
                }, 2000);
            </script>";
            exit();
        } else {
            // Imprime el error generado por MySQL
            echo "Error al insertar en la base de datos: " . $conn->error;
        }
    } else {
        echo "<script>
                alert('Contraseña incorrecta!');
                setTimeout(function(){
                    window.location.href = '/miskyyurax/views/pagina_login.php';
                }, 2000);
            </script>";
    }
} else {
    echo "<script>
            alert('USUARIO NO REGISTRADO');
            setTimeout(function(){
                window.location.href = '/miskyyurax/views/pagina_login.php';
            }, 2000);
        </script>";
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
