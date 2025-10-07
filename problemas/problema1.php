<?php
require_once("../clases/Problema1.php");
$problema = new Problema1(
    "Problema #1: Estadísticas de 5 números",
    "Calcular la media, desviación estándar, mínimo y máximo de 5 números ingresados."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeros = array_map('floatval', $_POST['numeros']);
    $resultado = $problema->ejecutar($numeros);
}

$problema->mostrarEncabezado("fondo-problema1", "numeros.png");
?>

<form method="POST">
    <label>Ingrese 5 números positivos:</label><br><br>
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <input type="number" name="numeros[]" step="0.01" min="0" required>
    <?php endfor; ?>
    <br><br>
    <input type="submit" value="Calcular" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <?php if (isset($resultado['error'])): ?>
        <p class="mensaje-error"><?= $resultado['error'] ?></p>
    <?php else: ?>
        <h3>Resultados:</h3>
        <ul>
            <li>Media: <?= $resultado['media'] ?></li>
            <li>Desviación Estándar: <?= $resultado['desviacion'] ?></li>
            <li>Mínimo: <?= $resultado['min'] ?></li>
            <li>Máximo: <?= $resultado['max'] ?></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<?php
$problema->mostrarCierre();
?>
