<?php
// Cargar la clase que procesa las ventas y crea la instancia con título/descripcion
require_once("../clases/Problema10.php");

$problema = new Problema10(
    "Problema #10: Ventas por vendedor y producto",
    "Ingresar los datos de 4 vendedores, 5 productos y las ventas del mes, luego mostrar el total por producto, por vendedor y general."
);

$resultado = [];

// Procesar formulario al enviarse (POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validación básica anti-CSRF (simulada aquí)
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== 'token_seguro') {
        $resultado = ['error' => "Error de seguridad. Intente nuevamente."];
    } else {
        // Recoger y sanitizar nombres de vendedores (4)
        $vendedores = [];
        for ($i = 0; $i < 4; $i++) {
            $vendedores[$i] = Problema10::sanitizarTexto($_POST["vendedor_{$i}"]);
        }

        // Recoger y sanitizar nombres de productos (5)
        $productos = [];
        for ($i = 0; $i < 5; $i++) {
            $productos[$i] = Problema10::sanitizarTexto($_POST["producto_{$i}"]);
        }

        // Recoger y validar matriz de ventas (5 productos x 4 vendedores)
        $ventas = [];
        $errores = [];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $clave = "venta_{$i}_{$j}";
                // sanitizarValorVenta intenta convertir el input a float >= 0, o retorna false
                $valor = Problema10::sanitizarValorVenta($_POST[$clave] ?? '0');
                
                if ($valor === false) {
                    $errores[] = "Valor inválido para el producto " . ($i+1) . " y vendedor " . ($j+1);
                } else {
                    $ventas[$i][$j] = $valor;
                }
            }
        }

        // Si hubo errores en los valores, preparar mensaje; si no, ejecutar cálculo
        if (!empty($errores)) {
            $resultado = ['error' => implode("<br>", $errores)];
        } else {
            $resultado = $problema->ejecutar($vendedores, $productos, $ventas);
        }
    }
}

// Mostrar la cabecera / fondo del problema
$problema->mostrarFondo("fondo-problema10");
?>

<div class="contenedor-problema">
    <?php if (empty($resultado) || isset($resultado['error'])): ?>
        <!-- Mostrar formulario para ingresar vendedores, productos y ventas -->
        <form method="POST" class="form-problema ventas-form">
            <input type="hidden" name="csrf_token" value="token_seguro">

            <div class="seccion-datos">
                <h3 class="seccion-titulo">📊 Datos de los Vendedores</h3>
                <div class="vendedores-grid">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <div class="input-group">
                            <label class="input-label">Vendedor <?= $i + 1 ?></label>
                            <!-- Mantener valor previo en caso de error para mejor UX -->
                            <input type="text" name="vendedor_<?= $i ?>" 
                                   value="<?= isset($_POST["vendedor_$i"]) ? htmlspecialchars($_POST["vendedor_$i"]) : '' ?>" 
                                   required class="form-input" placeholder="Nombre del vendedor">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="seccion-datos">
                <h3 class="seccion-titulo">📦 Datos de los Productos</h3>
                <div class="productos-grid">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <div class="input-group">
                            <label class="input-label">Producto <?= $i + 1 ?></label>
                            <input type="text" name="producto_<?= $i ?>" 
                                   value="<?= isset($_POST["producto_$i"]) ? htmlspecialchars($_POST["producto_$i"]) : '' ?>" 
                                   required class="form-input" placeholder="Nombre del producto">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="seccion-datos">
                <h3 class="seccion-titulo">💰 Ventas del Mes (en dólares)</h3>
                <p class="seccion-descripcion">Ingrese el total de ventas de cada producto por cada vendedor:</p>
                
                <div class="tabla-ventas-container">
                    <table class="tabla-ventas">
                        <thead>
                            <tr>
                                <th class="th-producto">Producto / Vendedor</th>
                                <?php for ($j = 0; $j < 4; $j++): ?>
                                    <th class="th-vendedor">
                                        <?php if (isset($resultado['vendedores'][$j])): ?>
                                            <?= htmlspecialchars($resultado['vendedores'][$j]) ?>
                                        <?php else: ?>
                                            Vendedor <?= $j + 1 ?>
                                        <?php endif; ?>
                                    </th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <tr>
                                    <td class="td-producto">
                                        <strong>
                                            <?php if (isset($resultado['productos'][$i])): ?>
                                                <?= htmlspecialchars($resultado['productos'][$i]) ?>
                                            <?php else: ?>
                                                Producto <?= $i + 1 ?>
                                            <?php endif; ?>
                                        </strong>
                                    </td>
                                    <?php for ($j = 0; $j < 4; $j++): ?>
                                        <td class="td-venta">
                                            <!-- Inputs numéricos con valor previo para corregir errores -->
                                            <input type="number" name="venta_<?= $i ?>_<?= $j ?>" 
                                                   step="0.01" min="0" 
                                                   value="<?= isset($_POST["venta_{$i}_{$j}"]) ? htmlspecialchars($_POST["venta_{$i}_{$j}"]) : '0' ?>" 
                                                   required class="input-venta" placeholder="0.00">
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" value="Calcular Totales" class="boton-problema calcular-btn">
            </div>
        </form>
    <?php endif; ?>

    <?php if (!empty($resultado)): ?>
        <?php if (isset($resultado['error'])): ?>
            <!-- Mensaje de error mostrado al usuario -->
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= $resultado['error'] ?>
            </div>
        <?php else: ?>
            <!-- Mostrar resultados: tabla con ventas y totales calculados -->
            <div class="resultado-ventas">
                <h3 class="resultado-titulo">📈 Resumen de Ventas del Mes</h3>
                
                <div class="tabla-resultados-container">
                    <table class="tabla-resultados">
                        <thead>
                            <tr>
                                <th class="th-producto">Producto / Vendedor</th>
                                <?php foreach ($resultado['vendedores'] as $vendedor): ?>
                                    <th class="th-vendedor"><?= htmlspecialchars($vendedor) ?></th>
                                <?php endforeach; ?>
                                <th class="th-total">Total Producto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultado['productos'] as $i => $producto): ?>
                                <tr>
                                    <td class="td-producto"><strong><?= htmlspecialchars($producto) ?></strong></td>
                                    <?php foreach ($resultado['vendedores'] as $j => $vendedor): ?>
                                        <td class="td-venta-resultado">$<?= number_format($resultado['ventas'][$i][$j], 2) ?></td>
                                    <?php endforeach; ?>
                                    <td class="td-total-producto"><strong>$<?= number_format($resultado['totalesPorProducto'][$i], 2) ?></strong></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="th-total">Total Vendedor</th>
                                <?php foreach ($resultado['totalesPorVendedor'] as $totalVendedor): ?>
                                    <th class="td-total-vendedor">$<?= number_format($totalVendedor, 2) ?></th>
                                <?php endforeach; ?>
                                <th class="td-total-general">$<?= number_format($resultado['totalGeneral'], 2) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="resumen-ventas">
                    <div class="resumen-card">
                        <div class="resumen-icono">💰</div>
                        <div class="resumen-info">
                            <span class="resumen-label">Total General</span>
                            <span class="resumen-valor">$<?= number_format($resultado['totalGeneral'], 2) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Botón para volver a llenar el formulario (GET limpia el POST) -->
                <div class="form-actions">
                    <form method="GET" style="display: inline;">
                        <button type="submit" class="boton-problema volver-btn">
                            🔄 Volver a Llenar Formulario
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
// Cerrar la plantilla (enlace de vuelta y footer)
$problema->mostrarCierre();
?>