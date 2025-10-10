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

<!-- Incluir Chart.js para las gráficas de barras -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

                <!-- Sección de gráficas de barras para mostrar la distribución -->
                <div class="graficas-container">
                    <h4>Distribución por Categorías</h4>
                    <div class="grafica-barras">
                        <canvas id="graficaEdades" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

                        <!-- Script para generar la gráfica de barras horizontal con Chart.js -->
            <script>
                // Datos para la gráfica de barras obtenidos desde PHP
                const datosEdades = {
                    categorias: ['Niños', 'Adolescentes', 'Adultos', 'Adultos Mayores'],
                    conteos: [
                        <?= $resultado["conteo"]["nino"] ?>,
                        <?= $resultado["conteo"]["adolescente"] ?>,
                        <?= $resultado["conteo"]["adulto"] ?>,
                        <?= $resultado["conteo"]["adulto_mayor"] ?>
                    ],
                    colores: [
                        '#28a745', // Verde para niños
                        '#007bff', // Azul para adolescentes
                        '#ffc107', // Amarillo para adultos
                        '#dc3545'  // Rojo para adultos mayores
                    ]
                };

                // Crear gráfica de barras horizontal
                const ctx = document.getElementById('graficaEdades').getContext('2d');
                const graficaEdades = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: datosEdades.categorias,
                        datasets: [{
                            label: 'Cantidad de Personas',
                            data: datosEdades.conteos,
                            backgroundColor: datosEdades.colores,
                            borderColor: datosEdades.colores,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y', // Esto hace las barras horizontales
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                },
                                title: {
                                    display: true,
                                    text: 'Cantidad de Personas'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Categorías de Edad'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Distribución de Edades por Categoría'
                            }
                        }
                    }
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
// Cerrar plantilla (enlace de vuelta y footer)
$problema->mostrarCierre();
?>