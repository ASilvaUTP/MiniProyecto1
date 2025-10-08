<?php
require_once("ProblemaBase.php");

class Problema10 extends ProblemaBase {

    public function ejecutar($vendedores, $productos, $ventas) {
        // Validar que se hayan ingresado los nombres de vendedores y productos
        if (count($vendedores) != 4 || count($productos) != 5) {
            return ['error' => "Debe ingresar exactamente 4 vendedores y 5 productos."];
        }

        // Validar que los nombres de vendedores y productos no estén vacíos
        foreach ($vendedores as $index => $nombre) {
            if (empty(trim($nombre))) {
                return ['error' => "El nombre del vendedor " . ($index+1) . " no puede estar vacío."];
            }
        }

        foreach ($productos as $index => $nombre) {
            if (empty(trim($nombre))) {
                return ['error' => "El nombre del producto " . ($index+1) . " no puede estar vacío."];
            }
        }

        // Validar estructura del arreglo de ventas
        if (empty($ventas) || !is_array($ventas)) {
            return ['error' => "⚠️ Debe ingresar los valores de venta para cada producto y vendedor."];
        }

        // Validar que todos los valores de ventas sean numéricos y no negativos
        foreach ($ventas as $i => $fila) {
            foreach ($fila as $j => $valor) {
                if (!is_numeric($valor) || $valor < 0) {
                    return ['error' => "⚠️ El valor de venta para el producto " . ($i+1) . " y vendedor " . ($j+1) . " debe ser un número positivo o cero."];
                }
            }
        }

        // Calcular totales
        $totalesPorProducto = array_fill(0, 5, 0);
        $totalesPorVendedor = array_fill(0, 4, 0);
        $totalGeneral = 0;

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $totalesPorProducto[$i] += $ventas[$i][$j];
                $totalesPorVendedor[$j] += $ventas[$i][$j];
                $totalGeneral += $ventas[$i][$j];
            }
        }

        return [
            'vendedores' => $vendedores,
            'productos' => $productos,
            'ventas' => $ventas,
            'totalesPorProducto' => $totalesPorProducto,
            'totalesPorVendedor' => $totalesPorVendedor,
            'totalGeneral' => $totalGeneral
        ];
    }
    
    public static function sanitizarTexto($texto) {
        return htmlspecialchars(trim($texto));
    }
    
    public static function sanitizarValorVenta($valor) {
        $valor = htmlspecialchars(trim($valor));
        return filter_var($valor, FILTER_VALIDATE_FLOAT, 
            ['options' => ['min_range' => 0]]
        );
    }
}
?>