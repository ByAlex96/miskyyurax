<?php
include('../config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php include '/xampp/htdocs/miskyyurax/views/head.php' ?>
<title>Perfil Misky Turax</title>
</head>

<body>

    <?php
    include('../scripts/selector_de_barras.php');
    ?>

    <main>
        <section class="container">
            <?php
            include('../scripts/mensaje_cambio.php');
            include '../scripts/bd.php';
            include('../scripts/autentificador_usuario.php');
            include('../views/barras/bienvenido.php');
            ?>

            <p>Formulario de Actualización</p>
            <!-- el formulario esta en el siguiente archivo, que a su vez se procesa en otro archivo -->
            <?php
            include('perfil/mostrar_info.php');
            ?>
        </section>
    </main>
    <?php include 'barras/footer.php' ?>
</body>

</html>