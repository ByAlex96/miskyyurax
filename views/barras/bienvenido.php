<?php
if (isset($_SESSION["valido"]) || isset($_SESSION["nombre"])) {
?>
    <h2>Hola! <?php echo htmlspecialchars($_SESSION['nombre']); ?> que te llevarás hoy?!</h2>
<?php
}
?>