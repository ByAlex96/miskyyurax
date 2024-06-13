<?php
include('../../config.php');
session_start();
include '../../scripts/bd.php';
include('../../scripts/autentificador_usuario.php');

$role = $_SESSION['role'];
$currentUserId = $_SESSION['usuario'];

if ($role == 'admin') {
    // Obtener la lista de usuarios si es administrador
    $userStmt = $conn->prepare('
        SELECT DISTINCT  u.IdUsuario, l.usuario, l.role 
        FROM usuarios u
        JOIN logins l ON u.IdUsuario = l.idUsuarioFK
    ');
    $userStmt->execute();
    $userStmt->store_result();
    $userStmt->bind_result($idUsuario, $usuario, $roleUsuario);

    $users = [];
    while ($userStmt->fetch()) {
        $users[] = ['id' => $idUsuario, 'name' => $usuario, 'role' => $roleUsuario];
    }
    $userStmt->close();
}

// Procesar la eliminación del usuario seleccionado
if (isset($_POST['delete_user']) && isset($_SESSION['panel_admin']) && $_SESSION['panel_admin'] == TRUE && isset($_SESSION['usuarioseleccionado'])) {
    $idUsuarioEliminar = $_SESSION['usuarioseleccionado'];

    if ($idUsuarioEliminar == $currentUserId) {
        $_SESSION['error'] = "No puedes eliminar tu propia cuenta. Selecciona otro usuario.";
    } else {
        // Eliminar el usuario seleccionado
        $stmt = $conn->prepare('DELETE FROM usuarios WHERE idUsuario = ?');
        $stmt->bind_param('i', $idUsuarioEliminar);

        if ($stmt->execute()) {
            $_SESSION['cambio'] = TRUE;
            unset($_SESSION['usuarioseleccionado']);
            unset($_SESSION['usuarioseleccionado_nombre']);
            unset($_SESSION['usuarioseleccionado_role']);
        } else {
            $_SESSION['error'] = "Error al eliminar el usuario. Inténtelo de nuevo.";
        }

        $stmt->close();
        header('Location: /miskyyurax/views/perfil/eliminar_usuario.php');
        exit();
    }
}

// Si se ha seleccionado un usuario desde el formulario
if (isset($_POST['user_id']) && $_POST['user_id'] !== '') {
    $idUsuario = $_POST['user_id'];

    // Obtener el usuario seleccionado
    $stmt = $conn->prepare('
        SELECT DISTINCT l.usuario, l.role 
        FROM usuarios u
        JOIN logins l ON u.IdUsuario = l.idUsuarioFK
        WHERE u.IdUsuario = ?
    ');
    $stmt->bind_param('i', $idUsuario);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($usuarioSeleccionado, $roleSeleccionado);
    $stmt->fetch();

    $_SESSION['usuarioseleccionado'] = $idUsuario;
    $_SESSION['usuarioseleccionado_nombre'] = $usuarioSeleccionado;
    $_SESSION['usuarioseleccionado_role'] = $roleSeleccionado;
    $stmt->close();
} else {
    // Si no hay usuario seleccionado, mostrar el propio usuario
    $idUsuario = $_SESSION['usuario'];
    $usuarioSeleccionado = $_SESSION['usuario'];
    $roleSeleccionado = $_SESSION['role'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '/xampp/htdocs/miskyyurax/views/head.php'; ?>
    <title>Eliminar usuario</title>
</head>

<body>
    <?php include('../../scripts/selector_de_barras.php'); ?>
    <main>
        <section class="container-fluid" style="background-color: #f0f0f0;">
            <div class="container w-75 py-5">
                <a href="javascript:history.back()" class="btn btn-primary mb-3">Volver</a>
                <?php include('../../scripts/mensaje_cambio.php'); ?>
                <h1 class="display-2 fw-bolder p-5">Eliminar Usuario</h1>
                <form method="post" action="" class="p-3 my-3">
                    <?php if (isset($_SESSION['panel_admin']) && $_SESSION['panel_admin'] == TRUE) { ?>
                        <label for="user_id">Seleccionar usuario a eliminar:</label>
                        <select class="form-control" id="user_id" name="user_id" onchange="this.form.submit()" required>
                            <?php foreach ($users as $user) { ?>
                                <option value="<?php echo htmlspecialchars($user['id']); ?>" <?php echo ($user['id'] == $idUsuario) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($user['name']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                    <?php } ?>
                </form>

                <form action="" method="post" class="py-2">
                    <?php if (isset($_SESSION['panel_admin']) && $_SESSION['panel_admin'] == TRUE && isset($usuarioSeleccionado)) { ?>
                        <p>Ahora tiene seleccionado al <?php echo $roleSeleccionado; ?> <?php echo $usuarioSeleccionado; ?> <br>
                            La eliminación de usuario es permanente e irreversible. Tenga cuidado.</p>
                        <?php if (isset($_SESSION['error']) && $_SESSION['error'] !== '') { ?>
                            <p style="color:red;"><?php echo $_SESSION['error'];
                                                    unset($_SESSION['error']); ?></p>
                        <?php } ?>
                        <div class="p-3">
                            <label for="confirmacion_check">¿Está seguro?</label>
                            <input type="checkbox" id="confirmacion_check" name="confirmacion_check" required>
                            <br><br>
                            <div>
                                <button class="btn btn-primary" type="submit" name="delete_user">Eliminar Usuario</button>
                                <button class="btn btn-primary" type="reset">Reiniciar</button>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </section>
    </main>
    <?php include '/xampp/htdocs/miskyyurax/views/barras/footer.php'; ?>
</body>

</html>