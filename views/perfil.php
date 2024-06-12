<?php
include('../config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" CONTENT="Alexander Pérez">
    <meta name="description" content="Contacto">
    <meta name="category" content="Bar">
    <link rel="icon" type="image/jpg" href="../photos/logo.png">
    <!-- ESTILO-->
    <link rel="stylesheet" href="../style/main.css">
    <!--Scripts JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

            <p>Bienvenido a tu perfil, aquí puedes ver y modificar tu información</p>
            <!-- el formulario esta en el siguiente archivo, que a su vez se procesa en otro archivo -->
            <?php
            include('perfil/mostrar_info.php');
            ?>
    </section>
    </main>
    <?php include 'barras/footer.php' ?>
</body>

</html>