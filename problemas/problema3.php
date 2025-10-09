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

$problema->mostrarFondo("fondo-problema3");
?>

<div class="contenedor-problema">
    <form method="POST" class="form-problema">
        <div class="form-group">
            <label class="form-label">Ingrese un número entero positivo (N):</label>
            <input type="number" name="numero" min="1" step="1" required 
                   class="form-input" placeholder="Ejemplo: 5">
        </div>
        <input type="submit" value="Mostrar múltiplos" class="boton-problema">
    </form>

    <?php if (!empty($resultado)): ?>
        <?php if (isset($resultado['error'])): ?>
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado['error']) ?>
            </div>
        <?php else: ?>
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
$problema->mostrarCierre();