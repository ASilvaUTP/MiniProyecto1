<?php
require_once("../clases/Problema6.php");

$problema = new Problema6(
    "Problema #6: Presupuesto Hospitalario",
    "Calcular la distribución del presupuesto anual entre Ginecología, Traumatología y Pediatría según porcentajes establecidos."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $presupuesto = floatval($_POST['presupuesto'] ?? 0);
    $resultado = $problema->ejecutar($presupuesto);
}

// Mostrar encabezado (ya incluye el título y descripción)
$problema->mostrarEncabezado("fondo-problema6", "");
?>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="contenedor-problema">
    <form method="POST" class="form-problema">
        <label>Ingrese el presupuesto anual total (USD):</label>
        <input type="number" name="presupuesto" step="0.01" min="0" placeholder="Ejemplo: 100000" required>
        <br><br>
        <input type="submit" value="Calcular distribución" class="boton-problema">
    </form>

    <?php if (!empty($resultado)): ?>
        <?php if (isset($resultado['error'])): ?>
            <p class="mensaje-error"><?= htmlspecialchars($resultado['error']) ?></p>
        <?php else: ?>
            <div class="resultado-contenedor">
                <div class="tabla-resultados">
                    <h3>Distribución del presupuesto:</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>Porcentaje</th>
                                <th>Monto Asignado (USD)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultado['areas'] as $area): ?>
                                <tr>
                                    <td><?= htmlspecialchars($area['area']) ?></td>
                                    <td><?= number_format($area['porcentaje'], 2) ?>%</td>
                                    <td>$<?= number_format($area['monto'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total Presupuesto</th>
                                <th>$<?= number_format($resultado['total'], 2) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="grafica-contenedor">
                    <h3>Gráfica de Distribución</h3>
                    <canvas id="graficaPresupuesto" width="400" height="300"></canvas>
                </div>
            </div>

            <script>
                // Datos para la gráfica desde PHP
                const datosPresupuesto = {
                    areas: [<?php foreach ($resultado['areas'] as $area): ?>'<?= $area['area'] ?>',<?php endforeach; ?>],
                    montos: [<?php foreach ($resultado['areas'] as $area): ?><?= $area['monto'] ?>,<?php endforeach; ?>],
                    porcentajes: [<?php foreach ($resultado['areas'] as $area): ?><?= $area['porcentaje'] ?>,<?php endforeach; ?>],
                    colores: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']
                };

                // Crear gráfica de pastel
                const ctx = document.getElementById('graficaPresupuesto').getContext('2d');
                const graficaPresupuesto = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: datosPresupuesto.areas,
                        datasets: [{
                            data: datosPresupuesto.montos,
                            backgroundColor: datosPresupuesto.colores,
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 12
                                    },
                                    padding: 20
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const porcentaje = datosPresupuesto.porcentajes[context.dataIndex];
                                        return `${label}: $${value.toLocaleString()} (${porcentaje.toFixed(2)}%)`;
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Distribución del Presupuesto Hospitalario',
                                font: {
                                    size: 16
                                }
                            }
                        }
                    }
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
$problema->mostrarCierre();
?>