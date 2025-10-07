<?php
require_once("ProblemaBase.php");

class Problema1 extends ProblemaBase {

    public function ejecutar($numeros) {
        // Validar que todos sean números no negativos
        foreach ($numeros as $num) {
            if ($num < 0) {
                // Retornar mensaje simple, sin error técnico
                return ['error' => "⚠️ No se permiten números negativos."];
            }
        }

        $n = count($numeros);
        $media = array_sum($numeros) / $n;

        $sumatoria = 0;
        foreach ($numeros as $num) {
            $sumatoria += pow($num - $media, 2);
        }

        $desviacion = sqrt($sumatoria / $n);
        $min = min($numeros);
        $max = max($numeros);

        return [
            'media' => round($media, 2),
            'desviacion' => round($desviacion, 2),
            'min' => $min,
            'max' => $max
        ];
    }
}
?>
