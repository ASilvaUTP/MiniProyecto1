<?php
// Carga la clase que realiza la suma
require_once("../clases/Problema2.php");

// Instancia el problema con título y descripción (se muestran en la plantilla)
$problema = new Problema2(
    "Problema #2: Suma del 1 al 1000",
    "Calcular la suma de los números del 1 al 1000 utilizando una estructura repetitiva."
);

// Si se envía el formulario, ejecutar el cálculo
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado = $problema->ejecutar();
}

// Mostrar la cabecera HTML del problema (título, descripción y estilo de fondo)
$problema->mostrarFondo("fondo-problema2");
?>

<div class="contenedor-problema">
    <!-- Formulario simple: al enviarlo se calcula la suma -->
    <form method="POST" class="form-problema">
        <div class="form-group">
            <p class="descripcion">Presione el botón para calcular la suma total de los números del 1 al 1000.</p>
        </div>
        <input type="submit" value="Calcular Suma" class="boton-problema">
    </form>

    <!-- Si hay resultado, mostrarlo formateado -->
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
// Imprime el cierre de la plantilla (enlace de vuelta y footer)
$problema->mostrarCierre();