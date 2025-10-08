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

$problema->mostrarEncabezado("fondo-problema9", "");
?>

<div class="contenedor-problema">
    <form method="POST" class="form-problema">
        <div class="form-group">
            <label class="form-label">Ingrese un número entre 1 y 9:</label>
            <input type="number" name="numero" min="1" max="9" required class="form-input" placeholder="Ejemplo: 2">
        </div>
        <input type="submit" value="Calcular potencias" class="boton-problema">
    </form>

    <?php if (!empty($resultado)): ?>
        <?php if (isset($resultado['error'])): ?>
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado['error']) ?>
            </div>
        <?php else: ?>
            <div class="resultado-potencias">
                <h3>Las 15 primeras potencias de <?= $resultado['numero'] ?> son:</h3>
                <div class="potencias-grid">
                    <?php foreach ($resultado['potencias'] as $linea): ?>
                        <div class="potencia-card">
                            <span class="potencia-texto"><?= $linea ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
$problema->mostrarCierre();