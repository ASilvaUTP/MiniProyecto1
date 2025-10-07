<?php
require_once("../clases/Problema4.php");
$problema = new Problema4(
    "Problema #4: Suma de números pares e impares",
    "Calcular por separado la suma de los números pares e impares comprendidos entre 1 y 200."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado = $problema->ejecutar();
}

$problema->mostrarEncabezado("fondo-problema4", "paresimpares.png");
?>

<form method="POST">
    <p>Presione el botón para calcular las sumas entre 1 y 200.</p>
    <input type="submit" value="Calcular sumas" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <h3>Resultados:</h3>
    <ul>
        <li><strong>Suma de pares:</strong> <?= $resultado['pares'] ?></li>
        <li><strong>Suma de impares:</strong> <?= $resultado['impares'] ?></li>
    </ul>
<?php endif; ?>

<?php
$problema->mostrarCierre();
?>
