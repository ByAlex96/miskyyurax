<?php
include('../config.php');
session_start();
include '../scripts/bd.php';
include('../scripts/autentificador_usuario.php');

// Inicializamos la variable de sesión que indica que es un administrador
$_SESSION['panel_admin'] = TRUE;

$role = $_SESSION['role'];

// Obtener la lista de usuarios si es administrador
if ($role == 'admin') {
    $userStmt = $conn->prepare('SELECT DISTINCT u.idUsuario, l.usuario FROM usuarios u INNER JOIN logins l ON u.IdUsuario = l.idUsuarioFK');

    $userStmt->execute();
    $userStmt->store_result();
    $userStmt->bind_result($idUsuario, $usuario);

    $users = [];
    while ($userStmt->fetch()) {
        $users[] = ['id' => $idUsuario, 'name' => $usuario];
    }
    $userStmt->close();
}

// Verificar si se ha seleccionado un usuario para mostrar sus datos
if (isset($_POST['seleccionar_usuario'])) {
    $selectedUserId = $_POST['user_id'];

    // Obtener los datos del usuario seleccionado
    $userDataStmt = $conn->prepare('SELECT nombre, apellidos, email, direccion, sexo, telefono FROM usuarios WHERE IdUsuario = ?');
    $userDataStmt->bind_param('i', $selectedUserId);
    $userDataStmt->execute();
    $userDataStmt->store_result();
    $userDataStmt->bind_result($nombre, $apellidos, $email, $direccion, $sexo, $telefono);

    // Verificar si se encontraron resultados
    if ($userDataStmt->fetch()) {
        // Datos encontrados, se procesa
    } else {
        // No se encontraron datos, manejar la situación (puede redireccionar o mostrar un mensaje)
    }

    $userDataStmt->close();
}

// Procesar la modificación del usuario
if (isset($_POST['modificar_usuario'])) {
    $selectedUserId = $_POST['selected_user_id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];

    // Verificar si el nuevo email ya está registrado para otro usuario
    $emailCheckStmt = $conn->prepare('SELECT IdUsuario FROM usuarios WHERE email = ? AND IdUsuario != ?');
    $emailCheckStmt->bind_param('si', $email, $selectedUserId);
    $emailCheckStmt->execute();
    $emailCheckStmt->store_result();

    if ($emailCheckStmt->num_rows > 0) {
        // El email ya está en uso por otro usuario
        echo "<script>alert('El correo electrónico ingresado ya está registrado. Por favor, elija otro.');</script>";
    } else {
        // Actualizar los datos del usuario en la base de datos
        $updateStmt = $conn->prepare('UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, direccion = ?, sexo = ?, telefono = ? WHERE IdUsuario = ?');
        $updateStmt->bind_param('ssssssi', $nombre, $apellidos, $email, $direccion, $sexo, $telefono, $selectedUserId);

        if ($updateStmt->execute()) {
            $_SESSION['cambio'] = TRUE;
            echo "<script>alert('Usuario actualizado correctamente.');</script>";
            // Puedes decidir si quieres refrescar la página o hacer alguna otra acción aquí
        } else {
            echo "Error al actualizar los datos del usuario.";
        }
        $updateStmt->close();
    }
    $emailCheckStmt->close();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '/xampp/htdocs/miskyyurax/views/head.php' ?>
    <title>Panel Administrativo</title>
</head>

<body>
    <?php
    include('../scripts/selector_de_barras.php');
    ?>

    <main>
        <?php
        include('../scripts/mensaje_cambio.php');
        ?>
        <section>
            <div class="container my-5">

                <h1 class="display-4 fw-bold">Panel de administrador de usuarios</h1>
                <p>Bienvenido al administrador de perfiles, aquí puedes crear, modificar o eliminar cuentas de usuarios.</p>
                <p>Cualquier cambio es irreversible, tenga mucho cuidado de no equivocarse.</p>

                <div class="d-flex flex-column align-items-center my-5">
                    <button class="btn btn-primary m-2 w-50" type="button" onclick="location.href='/miskyyurax/views/pagina_registro.php';">Crear nuevo usuario</button>
                    <form action="/miskyyurax/views/perfil/cambio_contraseña.php" class="w-50">
                        <button class="btn btn-primary m-2 w-100" type="submit">Cambiar contraseña</button>
                    </form>
                    <form action="/miskyyurax/views/perfil/eliminar_usuario.php" class="w-50">
                        <button class="btn btn-primary m-2 w-100" type="submit">Eliminar usuario</button>
                    </form>
                </div>

                <div>
                    <h2 class="m-3">Modificar usuario</h2>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary mx-2 mb-5" type="button" onclick="toggleForm('modificar')">Seleccionar usuario</button>
                    </div>
                    <div id="modificarForm" style="display: none;">
                        <form method="post" action="/miskyyurax/views/admin_usuarios.php" class="p-3 my-3">
                            <label for='user_id'>Seleccionar usuario a modificar:</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?php echo htmlspecialchars($user['id']); ?>"><?php echo htmlspecialchars($user['name']); ?></option>
                                <?php } ?>
                            </select><br>
                            <button class="btn btn-primary mb-2" type="submit" name="seleccionar_usuario">Seleccionar usuario</button>
                        </form>
                    </div>

                    <?php if (isset($selectedUserId)) { ?>
                        <h2 class="m-3">Editar información del usuario seleccionado</h2>
                        <form method="post" action="/miskyyurax/views/admin_usuarios.php" class="p-3 my-3">
                            <input type="hidden" name="selected_user_id" value="<?php echo $selectedUserId; ?>">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" pattern="[A-Za-z ]{3,30}" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input class="form-control" type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" pattern="[A-Za-z ]{3,30}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input class="form-control" type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" pattern="[a-zA-Z0-9._%+-]{5,255}" required>
                            </div>
                            <div class="mb-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-control" id="sexo" name="sexo" required>
                                    <option value="hombre" <?php if ($sexo === 'hombre') echo 'selected'; ?>>Hombre</option>
                                    <option value="mujer" <?php if ($sexo === 'mujer') echo 'selected'; ?>>Mujer</option>
                                    <option value="otro" <?php if ($sexo === 'otro') echo 'selected'; ?>>Otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Número de teléfono</label>
                                <input class="form-control" type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" pattern="[0-9]{9}" required>
                            </div>
                            <button class="btn btn-primary" type="submit" name="modificar_usuario">Modificar Usuario</button>
                        </form>
                    <?php } ?>
                </div>

            </div>
        </section>
    </main>

    <?php include 'barras/footer.php' ?>

    <script>
        function toggleForm(formId) {
            var crearForm = document.getElementById('crearForm');
            var modificarForm = document.getElementById('modificarForm');

            if (formId === 'crear') {
                crearForm.style.display = crearForm.style.display === 'none' ? 'block' : 'none';
                modificarForm.style.display = 'none';
            } else if (formId === 'modificar') {
                modificarForm.style.display = modificarForm.style.display === 'none' ? 'block' : 'none';
                crearForm.style.display = 'none';
            }
        }
    </script>
</body>

</html>