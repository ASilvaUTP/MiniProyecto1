<?php
// Cargar la clase que calcula las potencias
require_once("../clases/Problema9.php");

// Instancia del problema (título y descripción para la plantilla)
$problema = new Problema9(
    "Problema #9: Potencias de un número",
    "Generar las 15 primeras potencias de un número comprendido entre 1 y 9."
);

$resultado = [];

// Si llega un POST, tomar el número enviado y ejecutar la lógica de la clase
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = $_POST['numero'] ?? 0;
    $resultado = $problema->ejecutar($numero);
}

// Mostrar cabecera HTML (título/descripcion y apertura del body)
$problema->mostrarFondo("fondo-problema9");
?>

<div class="contenedor-problema">
    <!-- Formulario: pedir un número entre 1 y 9 -->
    <form method="POST" class="form-problema">
        <div class="form-group">
            <label class="form-label">Ingrese un número entre 1 y 9:</label>
            <input type="number" name="numero" min="1" max="9" required class="form-input" placeholder="Ejemplo: 2">
        </div>
        <input type="submit" value="Calcular potencias" class="boton-problema">
    </form>

    <!-- Mostrar mensajes / resultados devueltos por la clase Problema9 -->
    <?php if (!empty($resultado)): ?>
        <?php if (isset($resultado['error'])): ?>
            <!-- Mensaje de error validado en la clase -->
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado['error']) ?>
            </div>
        <?php else: ?>
            <!-- Listado de las 15 potencias generadas -->
            <div class="resultado-potencias">
                <h3>Las 15 primeras potencias de <?= htmlspecialchars($resultado['numero']) ?> son:</h3>
                <div class="potencias-grid">
                    <?php foreach ($resultado['potencias'] as $linea): ?>
                        <div class="potencia-card">
                            <!-- Cada línea ya viene formateada (uso de <sup>) desde la clase -->
                            <span class="potencia-texto"><?= $linea ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
// Cerrar plantilla (enlace de vuelta y footer)
$problema->mostrarCierre();
?>