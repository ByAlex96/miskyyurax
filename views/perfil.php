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
        <section >
            <div class="container w-75 py-3">
                <?php
                include('../scripts/mensaje_cambio.php');
                include '../scripts/bd.php';
                include('../scripts/autentificador_usuario.php');
                
                ?>

                <h2 class="display-2 fw-bolder mb-5">Formulario de Actualización</h2>
                <!-- el formulario esta en el siguiente archivo, que a su vez se procesa en otro archivo -->
                <?php
                include('perfil/mostrar_info.php');
                ?>
            </div>
        </section>
    </main>
    <?php include 'barras/footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>