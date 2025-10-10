<?php
require_once("ProblemaBase.php");

// Clase que procesa notas (entrada por pasos) y calcula estadísticas básicas
class Problema7 extends ProblemaBase {

    // Ejecutar recibe el arreglo $_POST (o similar) y actúa según el campo 'paso'
    public function ejecutar($post) {
        // Si estamos en el paso 3 se esperan las notas para procesar
        if (($post["paso"] ?? "") === "3") {
            $notas = $post["notas"] ?? [];
            // Validar que exista al menos una nota
            if (!is_array($notas) || empty($notas)) {
                return ["error" => "⚠️ Debe ingresar al menos una nota."];
            }

            $vals = [];
            $errores = [];
            // Validar cada nota: no vacía, numérica y en rango 0-100
            foreach ($notas as $i => $n) {
                if ($n === "" || !is_numeric($n) || $n < 0 || $n > 100) {
                    $errores[] = "Nota inválida en la posición ".($i+1).".";
                } else {
                    $vals[] = (float)$n;
                }
            }
            // Si hay errores de validación, devolverlos para mostrarlos en la vista
            if (!empty($errores)) {
                return ["errores" => $errores];
            }

            // Calcular promedio
            $count = count($vals);
            $sum = array_sum($vals);
            $prom = $count ? $sum / $count : 0.0;

            // Calcular varianza y desviación estándar poblacional
            $var = 0.0;
            foreach ($vals as $v) {
                $var += pow($v - $prom, 2);
            }
            $var = $count ? $var / $count : 0.0;
            $desv = sqrt($var);

            // Devolver estadísticas: promedio, desviación, mínimo y máximo
            return [
                "promedio" => $prom,
                "desviacion" => $desv,
                "min" => min($vals),
                "max" => max($vals)
            ];
        }

        // Para pasos distintos a 3 (por ejemplo inicio/selección), no hay datos aún
        return []; // Paso inicial o de selección de cantidad
    }
}
