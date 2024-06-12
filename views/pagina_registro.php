<?php
include('../config.php');
?>
<!DOCTYPE html>
<html lang="es">

<?php include '/xampp/htdocs/miskyyurax/views/head.php' ?>


<title>Registro Misky</title>
</head>

<body>
    <?php
    include('../scripts/selector_de_barras.php');
    ?>

    <main>
        <section>
            <div class="container  py-5">
                <h1 class="display-2 fw-bolder mb-2">Eres nuevo? regístrate aquí</h1>
                <p>Ya tiene cuenta? <a href="pagina_registro">Accede aquí</a></p>
                <!--la funcion se llamara a cualquier cambio del formulario.-->
                <form action="/miskyyurax/views/login/registrar.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" pattern="[A-Za-z ]{3,30}" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input class="form-control" type="text" id="apellidos" name="apellidos" pattern="[A-Za-z ]{3,30}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input class="form-control" type="email" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="Misky.yurax@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Numero de teléfono</label>
                        <input class="form-control" type="text" id="telefono" name="telefono" pattern="[0-9]{9}" placeholder="9 dígitos" required>

                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input class="form-control" type="text" id="direccion" name="direccion" pattern="[a-zA-Z0-9._%+-]{5,255}" placeholder="Calle El españoleto 31, 28010" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <select class="form-control" name="sexo" id="sexo" required>
                                <option autofocus value="">--Porfavor seleccione--</option>
                                <option value="hombre">Hombre</option>
                                <option value="mujer">Mujer</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Fecha de nacimiento">Fecha de nacimiento</label>
                            <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="phone">Usuario</label>
                        <input class="form-control" type="text" id="usuario" name="usuario" pattern="{3,30}" placeholder="Ej: entre 1 y 12 caracteres" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Contraseña</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Se requiere mínimo 8 caracteres, una letra mayúscula y un numero" pattern="{8,60}" required>
                    </div>
                    <div class="password_show">
                        <label for="check_password">Mostrar contraseña</label>
                        <input type="checkbox" id="check_password">
                    </div>
                    <script>
                        const check_password = document.getElementById("check_password")
                        const password_input = document.getElementById("password")

                        check_password.addEventListener("click", function() {
                            showHide_password(password_input)
                        });

                        function showHide_password(p_iput) {
                            if (p_iput.type === "password") {
                                p_iput.type = "text";
                            } else {
                                p_iput.type = "password";
                            }
                        }
                    </script>
                    <hr>

                    <label for="privacidad">Acepta nuestra <a href="#">política de privacidad?</a></label>
                    <input type="checkbox" id="privacidad" name="privacidad" required>
                    <div class="form_buttons">
                        <button class="btn btn-dark" type="submit" id="enviar">Enviar</button>
                        <button class="btn btn-dark" type="reset">Borrar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include 'barras/footer.php' ?>
</body>

</html>