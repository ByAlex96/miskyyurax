<?php
include('../config.php');
?>
<!DOCTYPE html>
<html lang="es">

<?php include '/xampp/htdocs/miskyyurax/views/head.php' ?>

<title>Inicio de Sesión</title>
</head>

<?php
include('../scripts/selector_de_barras.php');
?>
<main>
    <section>
        <div class="container py-5 text">
            <h1 class="display-2 fw-bolder mb-5">Iniciar sección</h1>
            <p>No tiene cuenta? <a href="pagina_registro">regístrate aquí</a></p>
            <!--la funcion se llamara a cualquier cambio del formulario.-->
            <form action="/miskyyurax/views/login/login.php" method="post">
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input class="form-control" type="text" id="usuario" name="usuario" placeholder="usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">contraseña</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="******" required>
                </div>
                <hr>
                <label for="privacidad">Acepta nuestra <a href="#">política de privacidad?</a></label>
                <input type="checkbox" id="privacidad" name="privacidad" required>
                <button class="btn btn-dark" type="submit" id="enviar">Enviar</button>
                <button class="btn btn-dark" type="reset">Borrar</button>
            </form>

        </div>
    </section>

</main>
<?php include 'barras/footer.php' ?>
</body>

</html>