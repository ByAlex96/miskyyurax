<?php
session_start();
include '../../scripts/bd.php';
include '../../scripts/autentificador_usuario.php';

$role = $_SESSION['role'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUsuario = $_SESSION['usuario'];
    $titulo = strip_tags($_POST['titulo']);
    $cuerpo = strip_tags($_POST['cuerpo']);
    $fecha = date('Y-m-d H:i:s');

    // Inicializar la variable de error
    $_SESSION['error'] = '';

    // Verificar que los campos obligatorios no estén vacíos
    if (empty($titulo) || empty($cuerpo)) {
        $_SESSION['error'] .= "El título y el cuerpo de la noticia son obligatorios. ";
    }

    // Manejar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = uniqid() . "_" . basename($_FILES['imagen']['name']);
        $directorio = '../../imagenes/';

        // Crear directorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        // Obtener la extensión del archivo
        $extension = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));

        // Lista de extensiones permitidas
        $extensionesPermitidas = array('jpg', 'jpeg', 'png');

        // Verificar si la extensión está permitida
        if (in_array($extension, $extensionesPermitidas)) {
            // Mover el archivo subido al directorio de imágenes
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombreImagen)) {
                $rutaImagen = 'imagenes/' . $nombreImagen;
            } else {
                $_SESSION['error'] .= "Error al mover la imagen subida. ";
            }
        } else {
            $_SESSION['error'] .= "Por favor, utiliza un formato válido (.jpg, .jpeg, .png). ";
        }
    } else {
        $_SESSION['error'] .= "Error en la subida de la imagen o no se ha subido ninguna imagen. ";
    }

    // Si no hay errores, insertar la noticia en la base de datos
    if ($_SESSION['error'] === '') {
        $stmt = $conn->prepare("INSERT INTO noticias (titulo, imagen, cuerpo, fecha, idUserFK) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            $_SESSION['error'] .= "Error en la preparación de la consulta: " . $conn->error . " ";
        } else {
            $stmt->bind_param("ssssi", $titulo, $rutaImagen, $cuerpo, $fecha, $idUsuario);

            // Ejecutar la declaración
            if ($stmt->execute()) {
                // La inserción fue exitosa
                $_SESSION['cambio'] = TRUE;
                header('Location: /miskyyurax/views/noticias.php');
                exit();
            } else {
                $_SESSION['error'] .= "Error en la ejecución de la consulta: " . $stmt->error . " ";
            }

            $stmt->close();
        }
    }
}

$conn->close();

// Redirigir a la página de noticias en caso de error o al finalizar
header('Location: /miskyyurax/views/noticias.php');
exit();
