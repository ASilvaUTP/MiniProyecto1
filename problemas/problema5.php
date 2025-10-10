<?php
// Cargar la clase que clasifica edades y crear la instancia con título/descripcion
require_once("../clases/Problema5.php");
$problema = new Problema5(
    "Problema #5: Clasificación de edades",
    "Leer la edad de 5 personas y clasificar cada una: niño (0–12), adolescente (13–17), adulto (18–64), adulto mayor (65+)."
);

$resultado = [];

// Si se envía el formulario por POST, obtener las edades y ejecutar la lógica
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $edades = $_POST['edad'] ?? [];
    $resultado = $problema->ejecutar($edades);
}

// Mostrar la cabecera HTML del problema (título y descripción)
$problema->mostrarFondo("fondo-problema5");
?>

<div class="contenedor-problema">
    <!-- Formulario: ingresar 5 edades -->
    <form method="post" class="form-problema">
        <div class="form-group">
            <h3 class="form-titulo">Ingrese 5 edades</h3>
            <div class="edades-grid">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="edad-input-group">
                        <label class="edad-label">Edad <?= $i ?></label>
                        <input type="number" name="edad[]" min="0" max="120" required 
                               class="edad-input" placeholder="0-120">
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <input type="submit" value="Clasificar Edades" class="boton-problema">
    </form>

    <?php if (!empty($resultado)): ?>
        <?php if (!empty($resultado["error"])): ?>
            <!-- Mostrar mensaje de error si la validación falló -->
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado["error"]) ?>
            </div>
        <?php else: ?>
            <!-- Mostrar tabla con detalle por cada edad y un resumen con conteos -->
            <div class="resultados-clasificacion">
                <h3>Resultados de Clasificación</h3>
                
                <div class="tabla-container">
                    <table class="tabla-edades">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Edad</th>
                                <th>Categoría</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultado["detalle"] as $fila): ?>
                                <tr>
                                    <td class="td-numero"><?= $fila["n"] ?></td>
                                    <td class="td-edad"><?= $fila["edad"] ?> años</td>
                                    <!-- Clase CSS basada en la categoría para estilos -->
                                    <td class="td-categoria categoria-<?= str_replace(' ', '_', strtolower($fila["categoria"])) ?>">
                                        <?= $fila["categoria"] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="estadisticas">
                    <h4>Resumen Estadístico</h4>
                    <div class="estadisticas-grid">
                        <!-- Mostrar conteos por categoría (niño, adolescente, adulto, adulto mayor) -->
                        <div class="estadistica-item nino">
                            <span class="estadistica-icon">👶</span>
                            <div class="estadistica-info">
                                <span class="estadistica-label">Niños</span>
                                <span class="estadistica-valor"><?= $resultado["conteo"]["nino"] ?></span>
                            </div>
                        </div>
                        <div class="estadistica-item adolescente">
                            <span class="estadistica-icon">🧑‍🎓</span>
                            <div class="estadistica-info">
                                <span class="estadistica-label">Adolescentes</span>
                                <span class="estadistica-valor"><?= $resultado["conteo"]["adolescente"] ?></span>
                            </div>
                        </div>
                        <div class="estadistica-item adulto">
                            <span class="estadistica-icon">👨‍💼</span>
                            <div class="estadistica-info">
                                <span class="estadistica-label">Adultos</span>
                                <span class="estadistica-valor"><?= $resultado["conteo"]["adulto"] ?></span>
                            </div>
                        </div>
                        <div class="estadistica-item adulto_mayor">
                            <span class="estadistica-icon">👵</span>
                            <div class="estadistica-info">
                                <span class="estadistica-label">Adultos Mayores</span>
                                <span class="estadistica-valor"><?= $resultado["conteo"]["adulto_mayor"] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
// Cerrar plantilla (enlace de vuelta y footer)
$problema->mostrarCierre();