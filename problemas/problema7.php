<?php
require_once("../clases/Problema7.php");
$problema = new Problema7(
    "Problema #7: Calculadora de datos estadísticos",
    "Ingrese la cantidad de notas, luego las notas. Calcular: promedio, desviación estándar, mínima y máxima."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado = $problema->ejecutar($_POST);
}

$problema->mostrarEncabezado("fondo-problema7", "estadistica.png");
?>

<form method="post" class="form-problema">
    <?php if (!isset($_POST["paso"]) || $_POST["paso"] !== "2"): ?>
        <input type="hidden" name="paso" value="2">
        <label>
            Cantidad de notas (1–50):
            <input type="number" name="cantidad" min="1" max="50" required>
        </label>
        <input type="submit" value="Continuar" class="boton-problema">
    <?php else: ?>
        <?php
        $cantidad = (int)($_POST["cantidad"] ?? 0);
        if ($cantidad < 1) $cantidad = 1;
        if ($cantidad > 50) $cantidad = 50;
        ?>
        <input type="hidden" name="paso" value="3">
        <fieldset>
            <legend>Ingrese <?= $cantidad ?> notas (0–100)</legend>
            <?php for ($i = 1; $i <= $cantidad; $i++): ?>
                <label>
                    Nota <?= $i ?>:
                    <input type="number" name="notas[]" step="0.01" min="0" max="100" required>
                </label>
            <?php endfor; ?>
        </fieldset>
        <input type="submit" value="Calcular" class="boton-problema">
    <?php endif; ?>
</form>

<?php if (!empty($resultado)): ?>
    <?php if (!empty($resultado["error"])): ?>
        <p class="mensaje-error"><?= htmlspecialchars($resultado["error"]) ?></p>
    <?php elseif (!empty($resultado["errores"])): ?>
        <div class="mensaje-error">
            <ul>
                <?php foreach ($resultado["errores"] as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <h3>Resultados</h3>
        <ul>
            <li>Promedio: <strong><?= number_format($resultado["promedio"], 2) ?></strong></li>
            <li>Desviación estándar: <strong><?= number_format($resultado["desviacion"], 2) ?></strong></li>
            <li>Mínima: <strong><?= number_format($resultado["min"], 2) ?></strong></li>
            <li>Máxima: <strong><?= number_format($resultado["max"], 2) ?></strong></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<?php
$problema->mostrarCierre();
