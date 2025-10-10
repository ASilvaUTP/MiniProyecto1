<?php
require_once("ProblemaBase.php");

// Clase que calcula la suma de los números pares e impares entre 1 y 200
class Problema4 extends ProblemaBase {

    // Ejecuta el cálculo y devuelve un arreglo con las sumas
    public function ejecutar() {
        $sumaPares = 0;   // acumulador para números pares
        $sumaImpares = 0; // acumulador para números impares

        // Recorrer del 1 al 200 y sumar según paridad
        for ($i = 1; $i <= 200; $i++) {
            if ($i % 2 == 0) {
                $sumaPares += $i;
            } else {
                $sumaImpares += $i;
            }
        }

        // Retornar resultados en formato consistente con otras clases
        return [
            'pares' => $sumaPares,
            'impares' => $sumaImpares
        ];
    }
}
?>
