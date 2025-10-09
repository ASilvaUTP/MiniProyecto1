<?php
require_once("../clases/Problema2.php");
$problema = new Problema2(
    "Problema #2: Suma del 1 al 1000",
    "Calcular la suma de los números del 1 al 1000 utilizando una estructura repetitiva."
);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado = $problema->ejecutar();
}

$problema->mostrarFondo("fondo-problema2");
?>

<div class="contenedor-problema">
    <form method="POST" class="form-problema">
        <div class="form-group">
            <p class="descripcion">Presione el botón para calcular la suma total de los números del 1 al 1000.</p>
        </div>
        <input type="submit" value="Calcular Suma" class="boton-problema">
    </form>

    <?php if (!empty($resultado)): ?>
        <div class="resultado-simple">
            <h3>Resultado:</h3>
            <div class="resultado-numero">
                <?= number_format($resultado['resultado']) ?>
            </div>
            <p class="resultado-desc">Suma total de los números del 1 al 1000</p>
        </div>
    <?php endif; ?>
</div>

<?php
$problema->mostrarCierre();