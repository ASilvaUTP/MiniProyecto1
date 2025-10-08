<?php
require_once("../clases/Problema9.php");
$problema = new Problema9(
    "Problema #9: Potencias de un número",
    "Generar las 15 primeras potencias de un número comprendido entre 1 y 9."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = $_POST['numero'] ?? 0;
    $resultado = $problema->ejecutar($numero);
}

$problema->mostrarEncabezado("fondo-problema9", "potencias.png");
?>

<form method="POST">
    <label>Ingrese un número entre 1 y 9:</label><br><br>
    <input type="number" name="numero" min="1" max="9" required>
    <br><br>
    <input type="submit" value="Calcular potencias" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <?php if (isset($resultado['error'])): ?>
        <p class="mensaje-error"><?= $resultado['error'] ?></p>
    <?php else: ?>
        <h3>Las 15 primeras potencias de <?= $resultado['numero'] ?> son:</h3>
        <ul>
            <?php foreach ($resultado['potencias'] as $linea): ?>
                <li><?= $linea ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<?php
$problema->mostrarCierre();
?>