<?php
require_once("../clases/Problema8.php");
$problema = new Problema8(
    "Problema #8: Estación del año",
    "Al ingresar una fecha, devolver la estación del año (hemisferio norte, por mes)."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha = $_POST['fecha'] ?? "";
    $resultado = $problema->ejecutar($fecha);
}

$problema->mostrarEncabezado("fondo-problema8", "estaciones.png");
?>

<form method="post" class="form-problema">
    <label>
        Fecha:
        <input type="date" name="fecha" required>
    </label>
    <input type="submit" value="Calcular estación" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <?php if (!empty($resultado["error"])): ?>
        <p class="mensaje-error"><?= htmlspecialchars($resultado["error"]) ?></p>
    <?php else: ?>
        <h3>Resultado</h3>
        <p>La estación para la fecha ingresada es: <strong><?= htmlspecialchars($resultado["estacion"]) ?></strong></p>
    <?php endif; ?>
<?php endif; ?>

<?php
$problema->mostrarCierre();
