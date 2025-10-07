<?php
require_once("../clases/Problema3.php");
$problema = new Problema3(
    "Problema #3: Múltiplos de 4",
    "Imprimir los N primeros múltiplos de 4, donde N es un número introducido por el usuario."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $n = $_POST['numero'] ?? 0;
    $resultado = $problema->ejecutar($n);
}

$problema->mostrarEncabezado("fondo-problema3", "multiplo4.png");
?>

<form method="POST">
    <label>Ingrese un número entero positivo (N):</label><br><br>
    <input type="number" name="numero" min="1" step="1" required>
    <br><br>
    <input type="submit" value="Mostrar múltiplos" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <?php if (isset($resultado['error'])): ?>
        <p class="mensaje-error"><?= $resultado['error'] ?></p>
    <?php else: ?>
        <h3>Los primeros <?= htmlspecialchars($_POST['numero']) ?> múltiplos de 4 son:</h3>
        <ul>
            <?php foreach ($resultado['multiplicaciones'] as $linea): ?>
                <li><?= $linea ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<?php
$problema->mostrarCierre();
?>
