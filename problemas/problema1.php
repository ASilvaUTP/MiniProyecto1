<?php
require_once("../clases/Problema1.php");
$problema = new Problema1(
    "Problema #1: Estadísticas de 5 números",
    "Calcular la media, desviación estándar, mínimo y máximo de 5 números ingresados."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeros = array_map('floatval', $_POST['numeros']);
    $resultado = $problema->ejecutar($numeros);
}

$problema->mostrarFondo("fondo-problema1");
?>

<div class="contenedor-problema">
    <form method="POST" class="form-problema estadistica-form">
        <div class="form-group">
            <label class="form-label">Ingrese 5 números positivos:</label>
            <div class="numeros-grid">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="numero-input-group">
                        <label class="numero-label">Número <?= $i ?></label>
                        <input type="number" name="numeros[]" step="0.01" min="0" required 
                               class="numero-input" placeholder="0.00">
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <input type="submit" value="Calcular Estadísticas" class="boton-problema">
    </form>

    <?php if (!empty($resultado)): ?>
        <?php if (isset($resultado['error'])): ?>
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado['error']) ?>
            </div>
        <?php else: ?>
            <div class="resultados-estadisticos">
                <h3 class="resultados-title">📊 Resultados Estadísticos</h3>
                
                <div class="estadisticas-grid">
                    <div class="estadistica-card">
                        <div class="estadistica-icon">📈</div>
                        <div class="estadistica-info">
                            <span class="estadistica-label">Media</span>
                            <span class="estadistica-valor"><?= number_format($resultado['media'], 2) ?></span>
                        </div>
                    </div>
                    
                    <div class="estadistica-card">
                        <div class="estadistica-icon">σ</div>
                        <div class="estadistica-info">
                            <span class="estadistica-label">Desviación Estándar</span>
                            <span class="estadistica-valor"><?= number_format($resultado['desviacion'], 2) ?></span>
                        </div>
                    </div>
                    
                    <div class="estadistica-card">
                        <div class="estadistica-icon">📉</div>
                        <div class="estadistica-info">
                            <span class="estadistica-label">Mínimo</span>
                            <span class="estadistica-valor minima"><?= number_format($resultado['min'], 2) ?></span>
                        </div>
                    </div>
                    
                    <div class="estadistica-card">
                        <div class="estadistica-icon">📈</div>
                        <div class="estadistica-info">
                            <span class="estadistica-label">Máximo</span>
                            <span class="estadistica-valor maxima"><?= number_format($resultado['max'], 2) ?></span>
                        </div>
                    </div>
                </div>
                
                <?php if (isset($resultado['numeros']) && is_array($resultado['numeros'])): ?>
                    <div class="numeros-lista">
                        <h4>Números ingresados:</h4>
                        <div class="numeros-chips">
                            <?php foreach ($resultado['numeros'] as $numero): ?>
                                <span class="numero-chip"><?= number_format($numero, 2) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
$problema->mostrarCierre();