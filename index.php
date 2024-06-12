<?php
include('config.php');
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<?php include '/xampp/htdocs/miskyyurax/views/head.php' ?>
<title>Misky Yurax</title>
</head>

<body>
    <?php
    include('scripts/selector_de_barras.php');
    ?>

    <main>
        <section class="main-section w-100 py-2">
            <?php
            include('views/barras/bienvenido.php');
            ?>


            <img class="home vh-80 d-flex">
            <div class=" row w-100">
                <div class="col-md-6 offset-md-3 homeContent">
                    <h2 class="display-2 fw-bolder mb-5">Deliciosas tartas para todos</h2>
                    <p class="mx-2">En Misky Yurax te invitamos a descubrir un mundo de sabores irresistibles,
                        donde la tradición peruana se fusiona con la innovación para crear postres que te cautivarán.
                        Nuestra carta
                        te ofrece una deliciosa variedad de clásicos reinventados, desde los alfajores más suaves y
                        delicados hasta
                        los picarones más crujientes y aromáticos. Cada bocado te transportará a la esencia de Perú, con
                        ingredientes
                        frescos y de primera calidad, preparados con el cariño y la pasión que nos caracteriza. Déjate
                        tentar por la
                        irresistible combinación de texturas y sabores de un Suspiro a la Limeña, disfruta de la cremosidad
                        inigualable de un Arroz con Leche, o experimenta la explosión de sabor de un Turrón de Doña Pepa. En
                        Misky Yurax cada postre es una obra de arte que despierta los sentidos. No pierdas la
                        oportunidad de
                        vivir una experiencia dulcemente inolvidable. ¡Visítanos y descubre la magia de la repostería
                        peruana!</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3 homeContent">
                    <?php if (!isset($_SESSION["valido"]) || $_SESSION["valido"] !== TRUE) {
                        echo "<h2>Hazte Cliente!</h2>
                            <p>¿Quieres reservar o acceder a promociones especiales? Hazte cliente gratis y disfruta los dulces peruanos!</p>
                            <p>No tiene cuenta? <a href='pagina_registro'>Registrate</a></p>
                            <p>Ya tiene cuenta? <a href='pagina_registro'>Accede</a></p>";
                    }
                    ?>
                </div>
            </div>

        </section>

        <?php include 'views/home/slider.php' ?>
        <?php include 'views/home/cards.php' ?>
        <?php include 'views/home/testimonio.php' ?>

    </main>

    <?php include 'views/barras/footer.php' ?>
</body>

</html>