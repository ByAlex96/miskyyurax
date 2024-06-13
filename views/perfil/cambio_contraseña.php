<?php
include('../../config.php');
session_start();
include '../../scripts/bd.php';
include('../../scripts/autentificador_usuario.php');

$role = $_SESSION['role'];

if ($role == 'admin') {
    // Obtener la lista de usuarios si es administrador
    $userStmt = $conn->prepare('
        SELECT DISTINCT u.IdUsuario, l.usuario, l.role 
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
//esto es solamente si eres un usuario
if (isset($_POST['user_id']) && $_POST['user_id'] !== '') {
    $idUsuario = $_POST['user_id'];

    // Obtener el usuario seleccionado
    $stmt = $conn->prepare('
        SELECT l.usuario, l.role 
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
    $idUsuario = $_SESSION['usuario'];
    $usuarioSeleccionado = $_SESSION['usuario'];
    $roleSeleccionado = $_SESSION['role'];
}
?>
<!DOCTYPE html>
<html lang="es">

    <?php include '/xampp/htdocs/miskyyurax/views/head.php' ?>
    <title>Cambiar contraseña</title>
</head>

<body>
<?php include('../../scripts/selector_de_barras.php'); ?>
    <main>
    <section class="container">
        <div class="container">
            <?php include('../../scripts/mensaje_cambio.php'); ?>
            <form method="post" action="" class="p-3 my-3">
                <?php if (isset($_SESSION['panel_admin']) && $_SESSION['panel_admin'] == TRUE) {
                    echo '<label for="user_id">Seleccionar usuario a modificar:</label>
        <select class="form-control" id="user_id" name="user_id" required>'; ?>
                    <?php foreach ($users as $user) { ?>
                        <option value="<?php echo htmlspecialchars($user['id']); ?>" <?php echo ($user['id'] == $idUsuario) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($user['name']); ?>
                        </option>
                    <?php } ?>
                <?php echo '
        </select><br>
    ';
                } ?>

                
            </form>
            <h1 class="display-2 fw-bolder mb-5">Cambia tu contraseña</h1>
            <form action="/miskyyurax/views/perfil/actualizar_contraseña.php" method="post" class="py-2">
                <?php if (isset($_SESSION['panel_admin']) && $_SESSION['panel_admin'] == TRUE) {
                    echo "Hola, en que te puedo ayudar hoy? </br> </br>";
                } ?>
                <div class="form-group">
                    <?php if (isset($_SESSION['panel_admin']) && $_SESSION['panel_admin'] == TRUE) {
                    } else {
                        echo '
            <label for="password">Contraseña vieja</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Se requiere mínimo 8 caracteres, una letra mayúscula y un número" pattern=".{8,60}" required>
        </div>';
                    } ?>
                    <div class="form-group">
                        <label for="passwordnueva">Contraseña nueva</label>
                        <input class="form-control" type="password" id="passwordnueva" name="passwordnueva" placeholder="Se requiere mínimo 8 caracteres, una letra mayúscula y un número" pattern=".{8,60}" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmacion">Vuelve a introducir la contraseña nueva</label>
                        <input class="form-control" type="password" id="confirmacion" name="confirmacion" placeholder="Se requiere mínimo 8 caracteres, una letra mayúscula y un número" pattern=".{8,60}" required>
                    </div>
                    <div class="p-3">
                    <input type="checkbox" id="confirmacion_check" name="confirmacion_check" required>
                        <label for="confirmacion_check">¿Está seguro?</label></div> 
                        
                        </br>
                        <div>
                        <button class="btn btn-dark" type="submit">Actualizar Datos</button>
                        <button class="btn btn-dark" type="reset">Reiniciar</button>
                        </div>
                    </div>
            </form>
        </div>
        </section>
        
    </main>
    <?php include '/xampp/htdocs/miskyyurax/views/barras/footer.php' ?>
</body>

</html>