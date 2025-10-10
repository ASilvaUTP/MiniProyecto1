<?php
require_once("ProblemaBase.php");

// Clase que calcula estadísticas básicas (media, desviación estándar, mínimo y máximo)
class Problema1 extends ProblemaBase {

    // Ejecuta el cálculo sobre un array de números (se espera que sean no negativos)
    public function ejecutar($numeros) {
        // Validar que todos sean números positivos
        foreach ($numeros as $num) {
            if ($num < 0) {
                // Si hay negativos, devolver un arreglo con clave 'error'
                return ['error' => "⚠️ No se permiten números negativos."];
            }
        }

        $n = count($numeros); // número de elementos
        $media = array_sum($numeros) / $n; // media aritmética

        // Calcular la suma de las diferencias al cuadrado (para varianza)
        $sumatoria = 0;
        foreach ($numeros as $num) {
            $sumatoria += pow($num - $media, 2);
        }

        $desviacion = sqrt($sumatoria / $n); // desviación estándar poblacional
        $min = min($numeros); // valor mínimo
        $max = max($numeros); // valor máximo

        // Devolver resultados con redondeo para presentación
        return [
            'media' => round($media, 2),
            'desviacion' => round($desviacion, 2),
            'min' => $min,
            'max' => $max
        ];
    }
}
?>