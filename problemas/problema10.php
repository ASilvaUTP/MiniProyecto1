<?php
require_once("../clases/Problema10.php");

$problema = new Problema10(
    "Problema #10: Ventas por vendedor y producto",
    "Ingresar los datos de 4 vendedores, 5 productos y las ventas del mes, luego mostrar el total por producto, por vendedor y general."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar token CSRF (simulado)
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== 'token_seguro') {
        $resultado = ['error' => "Error de seguridad. Intente nuevamente."];
    } else {
        // Recoger y validar datos de vendedores
        $vendedores = [];
        for ($i = 0; $i < 4; $i++) {
            $vendedores[$i] = Problema10::sanitizarTexto($_POST["vendedor_{$i}"]);
        }

        // Recoger y validar datos de productos
        $productos = [];
        for ($i = 0; $i < 5; $i++) {
            $productos[$i] = Problema10::sanitizarTexto($_POST["producto_{$i}"]);
        }

        // Recoger y validar datos de ventas
        $ventas = [];
        $errores = [];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $clave = "venta_{$i}_{$j}";
                $valor = Problema10::sanitizarValorVenta($_POST[$clave] ?? '0');
                
                if ($valor === false) {
                    $errores[] = "Valor inválido para el producto " . ($i+1) . " y vendedor " . ($j+1);
                } else {
                    $ventas[$i][$j] = $valor;
                }
            }
        }

        if (!empty($errores)) {
            $resultado = ['error' => implode("<br>", $errores)];
        } else {
            $resultado = $problema->ejecutar($vendedores, $productos, $ventas);
        }
    }
}

$problema->mostrarEncabezado("fondo-problema10", "ventas.png");
?>

<form method="POST">
    <input type="hidden" name="csrf_token" value="token_seguro">

    <h3>Datos de los Vendedores</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="margin:auto; border-collapse: collapse; text-align:center;">
        <thead style="background-color:#b2dfdb;">
            <tr>
                <th>Número</th>
                <th>Nombre del Vendedor</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 4; $i++): ?>
                <tr>
                    <td><strong>Vendedor <?= $i + 1 ?></strong></td>
                    <td>
                        <input type="text" name="vendedor_<?= $i ?>" value="<?= isset($_POST["vendedor_$i"]) ? htmlspecialchars($_POST["vendedor_$i"]) : '' ?>" required>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <br>

    <h3>Datos de los Productos</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="margin:auto; border-collapse: collapse; text-align:center;">
        <thead style="background-color:#b2dfdb;">
            <tr>
                <th>Número</th>
                <th>Nombre del Producto</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>
                    <td><strong>Producto <?= $i + 1 ?></strong></td>
                    <td>
                        <input type="text" name="producto_<?= $i ?>" value="<?= isset($_POST["producto_$i"]) ? htmlspecialchars($_POST["producto_$i"]) : '' ?>" required>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <br>

    <h3>Ventas del Mes (en dólares)</h3>
    <p>Ingrese el total de ventas de cada producto por cada vendedor:</p>
    <table border="1" cellpadding="8" cellspacing="0" style="margin:auto; border-collapse: collapse; text-align:center;">
        <thead style="background-color:#b2dfdb;">
            <tr>
                <th>Producto / Vendedor</th>
                <?php for ($j = 0; $j < 4; $j++): ?>
                    <th>
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
                    <td>
                        <strong>
                            <?php if (isset($resultado['productos'][$i])): ?>
                                <?= htmlspecialchars($resultado['productos'][$i]) ?>
                            <?php else: ?>
                                Producto <?= $i + 1 ?>
                            <?php endif; ?>
                        </strong>
                    </td>
                    <?php for ($j = 0; $j < 4; $j++): ?>
                        <td>
                            <input type="number" name="venta_<?= $i ?>_<?= $j ?>" step="0.01" min="0" value="<?= isset($_POST["venta_{$i}_{$j}"]) ? htmlspecialchars($_POST["venta_{$i}_{$j}"]) : '0' ?>" required>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <br>
    <input type="submit" value="Calcular Totales" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <?php if (isset($resultado['error'])): ?>
        <p class="mensaje-error"><?= $resultado['error'] ?></p>
    <?php else: ?>
        <h3>Resumen de Ventas del Mes:</h3>
        <table border="1" cellpadding="8" cellspacing="0" style="margin:auto; border-collapse: collapse; text-align:center;">
            <thead style="background-color:#dcedc8;">
                <tr>
                    <th>Producto / Vendedor</th>
                    <?php foreach ($resultado['vendedores'] as $vendedor): ?>
                        <th><?= htmlspecialchars($vendedor) ?></th>
                    <?php endforeach; ?>
                    <th>Total Producto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado['productos'] as $i => $producto): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($producto) ?></strong></td>
                        <?php foreach ($resultado['vendedores'] as $j => $vendedor): ?>
                            <td><?= number_format($resultado['ventas'][$i][$j], 2) ?></td>
                        <?php endforeach; ?>
                        <td><strong><?= number_format($resultado['totalesPorProducto'][$i], 2) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot style="background-color:#f0f4c3;">
                <tr>
                    <th>Total Vendedor</th>
                    <?php foreach ($resultado['totalesPorVendedor'] as $totalVendedor): ?>
                        <th><?= number_format($totalVendedor, 2) ?></th>
                    <?php endforeach; ?>
                    <th><?= number_format($resultado['totalGeneral'], 2) ?></th>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>
<?php endif; ?>

<?php
$problema->mostrarCierre();
?>