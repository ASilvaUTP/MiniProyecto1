<?php
require_once("../clases/Problema2.php");
$problema = new Problema2(
    "Problema #2: Suma del 1 al 1000",
    "Calcular la suma de los números del 1 al 1000 utilizando una estructura repetitiva."
);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado = $problema->ejecutar();
}

$problema->mostrarEncabezado("fondo-problema2", "suma.png");
?>

<form method="POST">
    <p>Presione el botón para calcular la suma total de los números del 1 al 1000.</p>
    <input type="submit" value="Calcular" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <h3>Resultado:</h3>
    <p>La suma de los números del 1 al 1000 es: <strong><?= $resultado['resultado'] ?></strong></p>
<?php endif; ?>

<?php
$problema->mostrarCierre();
?>
