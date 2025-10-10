<?php
// Cargar la clase que calcula las sumas
require_once("../clases/Problema4.php");

// Crear instancia con título y descripción (usadas en la plantilla)
$problema = new Problema4(
    "Problema #4: Suma de números pares e impares",
    "Calcular por separado la suma de los números pares e impares comprendidos entre 1 y 200."
);

$resultado = [];

// Si se recibe POST, ejecutar la lógica y obtener el resultado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado = $problema->ejecutar();
}

// Mostrar la cabecera HTML del problema (título, descripción y estilo de fondo)
$problema->mostrarFondo("fondo-problema4");
?>

<div class="contenedor-problema">
    <!-- Formulario simple: al enviarlo calcula las sumas -->
    <form method="POST" class="form-problema">
        <div class="form-group">
            <p class="descripcion">Presione el botón para calcular las sumas entre 1 y 200.</p>
        </div>
        <input type="submit" value="Calcular Sumas" class="boton-problema">
    </form>

    <!-- Mostrar resultados si la ejecución devolvió datos -->
    <?php if (!empty($resultado)): ?>
        <div class="resultado-sumas">
            <h3>Resultados:</h3>
            <div class="sumas-grid">
                <div class="suma-card par">
                    <div class="suma-icono">🔵</div>
                    <div class="suma-info">
                        <span class="suma-label">Suma de Pares</span>
                        <span class="suma-valor"><?= number_format($resultado['pares']) ?></span>
                    </div>
                </div>
                <div class="suma-card impar">
                    <div class="suma-icono">🔴</div>
                    <div class="suma-info">
                        <span class="suma-label">Suma de Impares</span>
                        <span class="suma-valor"><?= number_format($resultado['impares']) ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
// Cerrar la plantilla (enlace de vuelta y footer)
$problema->mostrarCierre();