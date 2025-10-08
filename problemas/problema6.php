<?php
require_once("../clases/Problema6.php");
$problema = new Problema6(
    "Problema #6: Presupuesto del hospital",
    "Distribuye el presupuesto anual entre Ginecología (40%), Traumatología (35%) y Pediatría (25%)."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $presupuesto = $_POST['presupuesto'] ?? null;
    $resultado = $problema->ejecutar($presupuesto);
}

$problema->mostrarEncabezado("fondo-problema6", "hospital.png");
?>

<form method="post" class="form-problema">
    <label>
        Monto del presupuesto (USD):
        <input type="number" name="presupuesto" step="0.01" min="0" required>
    </label>
    <input type="submit" value="Calcular distribución" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <?php if (!empty($resultado["error"])): ?>
        <p class="mensaje-error"><?= htmlspecialchars($resultado["error"]) ?></p>
    <?php else: ?>
        <h3>Distribución</h3>
        <table class="tabla">
            <thead><tr><th>Área</th><th>%</th><th>Monto (USD)</th></tr></thead>
            <tbody>
            <?php foreach ($resultado["areas"] as $fila): ?>
                <tr>
                    <td><?= $fila["area"] ?></td>
                    <td><?= $fila["porcentaje"] ?>%</td>
                    <td><?= number_format($fila["monto"], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th><th>100%</th><th><?= number_format($resultado["total"], 2) ?></th>
            </tr>
            </tfoot>
        </table>
    <?php endif; ?>
<?php endif; ?>

<?php
$problema->mostrarCierre();
