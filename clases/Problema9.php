<?php
require_once("ProblemaBase.php");

// Clase que calcula las potencias de un número (exponentes 1..15)
class Problema9 extends ProblemaBase {

    // Recibe un número (1-9), valida y devuelve una lista con sus potencias
    public function ejecutar($numero) {
        // Validar rango y tipo
        if (!is_numeric($numero) || $numero < 1 || $numero > 9) {
            return ['error' => "⚠️ Debe ingresar un número entre 1 y 9."];
        }

        $numero = intval($numero);
        $resultados = [];

        // Generar potencias desde el exponente 1 hasta 15
        for ($i = 1; $i <= 15; $i++) {
            $potencia = pow($numero, $i);
            // Formato: "n^i = resultado" (uso de <sup> para presentación en HTML)
            $resultados[] = "{$numero}<sup>{$i}</sup> = {$potencia}";
        }

        // Devolver arreglo con las potencias y el número original
        return ['potencias' => $resultados, 'numero' => $numero];
    }
}
?>
