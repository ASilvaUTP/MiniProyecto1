<?php
// Cargar la clase que genera los múltiplos de 4
require_once("../clases/Problema3.php");

// Crear instancia con título y descripción (se usan en la plantilla)
$problema = new Problema3(
    "Problema #3: Múltiplos de 4",
    "Imprimir los N primeros múltiplos de 4, donde N es un número introducido por el usuario."
);

$resultado = [];

// Si el formulario se envió, tomar el valor y ejecutar la lógica del problema
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $n = $_POST['numero'] ?? 0;
    $resultado = $problema->ejecutar($n);
}

// Mostrar la cabecera HTML (título, descripción y estilos de fondo)
$problema->mostrarFondo("fondo-problema3");
?>

<div class="contenedor-problema">
    <!-- Formulario: pedir un entero positivo al usuario -->
    <form method="POST" class="form-problema">
        <div class="form-group">
            <label class="form-label">Ingrese un número entero positivo (N):</label>
            <input type="number" name="numero" min="1" step="1" required 
                   class="form-input" placeholder="Ejemplo: 5">
        </div>
        <input type="submit" value="Mostrar múltiplos" class="boton-problema">
    </form>

    <!-- Mostrar resultados si existen -->
    <?php if (!empty($resultado)): ?>
        <?php if (isset($resultado['error'])): ?>
            <!-- Mensaje de error proveniente de la clase -->
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado['error']) ?>
            </div>
        <?php else: ?>
            <!-- Lista de multiplicaciones generadas por la clase Problema3 -->
            <div class="resultado-multiplos">
                <h3>Los primeros <?= htmlspecialchars($_POST['numero']) ?> múltiplos de 4 son:</h3>
                <div class="multiplos-grid">
                    <?php foreach ($resultado['multiplicaciones'] as $linea): ?>
                        <div class="multiplo-card">
                            <?= $linea ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
// Cerrar la plantilla (enlace de vuelta y footer)
$problema->mostrarCierre();
?>