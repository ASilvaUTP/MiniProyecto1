<?php
require_once("ProblemaBase.php");

class Problema7 extends ProblemaBase {

    public function ejecutar($post) {
        if (($post["paso"] ?? "") === "3") {
            $notas = $post["notas"] ?? [];
            if (!is_array($notas) || empty($notas)) {
                return ["error" => "⚠️ Debe ingresar al menos una nota."];
            }

            $vals = [];
            $errores = [];
            foreach ($notas as $i => $n) {
                if ($n === "" || !is_numeric($n) || $n < 0 || $n > 100) {
                    $errores[] = "Nota inválida en la posición ".($i+1).".";
                } else {
                    $vals[] = (float)$n;
                }
            }
            if (!empty($errores)) {
                return ["errores" => $errores];
            }

            $count = count($vals);
            $sum = array_sum($vals);
            $prom = $count ? $sum / $count : 0.0;

            $var = 0.0;
            foreach ($vals as $v) {
                $var += pow($v - $prom, 2);
            }
            $var = $count ? $var / $count : 0.0;
            $desv = sqrt($var);

            return [
                "promedio" => $prom,
                "desviacion" => $desv,
                "min" => min($vals),
                "max" => max($vals)
            ];
        }

        return []; // Paso inicial o de selección de cantidad
    }
}
