<?php
if (isset($_SESSION["valido"]) || isset($_SESSION["nombre"])) {
?>
    <h2 class="py-3">Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?> que te llevarás hoy?</h2>
<?php
}
?>