<?php
require_once("../clases/Problema7.php");
$problema = new Problema7(
    "Problema #7: Calculadora de Datos Estadísticos",
    "Ingrese la cantidad de notas, luego las notas. Calcular: promedio, desviación estándar, mínima y máxima."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado = $problema->ejecutar($_POST);
}

$problema->mostrarEncabezado("fondo-problema7", "");
?>

<div class="contenedor-problema">
    <form method="post" class="form-problema estadistica-form">
        <?php if (!isset($_POST["paso"]) || $_POST["paso"] !== "2"): ?>
            <input type="hidden" name="paso" value="2">
            <div class="form-group">
                <label class="form-label">
                    Cantidad de notas (1–50):
                </label>
                <input type="number" name="cantidad" min="1" max="50" required 
                       class="form-input" placeholder="Ejemplo: 5">
            </div>
            <input type="submit" value="Continuar" class="boton-problema">
        <?php else: ?>
            <?php
            $cantidad = (int)($_POST["cantidad"] ?? 0);
            if ($cantidad < 1) $cantidad = 1;
            if ($cantidad > 50) $cantidad = 50;
            ?>
            <input type="hidden" name="paso" value="3">
            <input type="hidden" name="cantidad" value="<?= $cantidad ?>">
            
            <div class="notas-container">
                <h3 class="notas-title">Ingrese <?= $cantidad ?> notas (0–100)</h3>
                <div class="notas-grid">
                    <?php for ($i = 1; $i <= $cantidad; $i++): ?>
                        <div class="nota-input-group">
                            <label class="nota-label">
                                Nota <?= $i ?>:
                            </label>
                            <input type="number" name="notas[]" step="0.01" min="0" max="100" 
                                   required class="nota-input" placeholder="0-100">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" value="Calcular Estadísticas" class="boton-problema calcular-btn">
                <button type="button" onclick="history.back()" class="boton-problema secundario">Volver</button>
            </div>
        <?php endif; ?>
    </form>

    <?php if (!empty($resultado)): ?>
        <?php if (!empty($resultado["error"])): ?>
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado["error"]) ?>
            </div>
        <?php elseif (!empty($resultado["errores"])): ?>
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <h4>Errores encontrados:</h4>
                <ul>
                    <?php foreach ($resultado["errores"] as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <div class="resultados-estadisticos">
                <h3 class="resultados-title">📊 Resultados Estadísticos</h3>
                
                <div class="estadisticas-grid">
                    <div class="estadistica-card">
                        <div class="estadistica-icon">📈</div>
                        <div class="estadistica-info">
                            <span class="estadistica-label">Promedio</span>
                            <span class="estadistica-valor"><?= number_format($resultado["promedio"], 2) ?></span>
                        </div>
                    </div>
                    
                    <div class="estadistica-card">
                        <div class="estadistica-icon">📐</div>
                        <div class="estadistica-info">
                            <span class="estadistica-label">Desviación Estándar</span>
                            <span class="estadistica-valor"><?= number_format($resultado["desviacion"], 2) ?></span>
                        </div>
                    </div>
                    
                    <div class="estadistica-card">
                        <div class="estadistica-icon">📉</div>
                        <div class="estadistica-info">
                            <span class="estadistica-label">Nota Mínima</span>
                            <span class="estadistica-valor minima"><?= number_format($resultado["min"], 2) ?></span>
                        </div>
                    </div>
                    
                    <div class="estadistica-card">
                        <div class="estadistica-icon">📈</div>
                        <div class="estadistica-info">
                            <span class="estadistica-label">Nota Máxima</span>
                            <span class="estadistica-valor maxima"><?= number_format($resultado["max"], 2) ?></span>
                        </div>
                    </div>
                </div>
                
                <?php if (isset($resultado["notas"]) && is_array($resultado["notas"])): ?>
                    <div class="notas-lista">
                        <h4>Notas ingresadas:</h4>
                        <div class="notas-chips">
                            <?php foreach ($resultado["notas"] as $nota): ?>
                                <span class="nota-chip"><?= number_format($nota, 2) ?></span>
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